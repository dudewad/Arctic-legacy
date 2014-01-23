$rootPath = $PSScriptRoot;
$baseDir = $rootPath + "\..\";
$constantsFile = $baseDir + "\include\class\Utility\Constants.php";
$sassVarsFile = $baseDir + "\css\sass\include\appVars.scss";
$constants = Get-Content $constantsFile;
$constObjs = @();
$constantsToUse = @();

#Used for replacing each constant into the SCSS
function constObj($a){
    $obj = @{varName=$a[0];varValue=$a[1]};
    return $obj;
}

##########################################################################
#Grab application constant names to use from the top of the constants file
##########################################################################
$patString = [regex] '@SCSSEXPORT\s*=\s*\[(?:"(?<const>.*?)",*)*\];';
$result = $patString.match($constants);
foreach($c in $result.Groups['const'].Captures){
    $constantsToUse += $c;
}

################################################################################
#Get the application constants first.
#Each constant needs to be stored as a constObj (defined above) as key/val pairs
################################################################################

foreach($const in $constantsToUse){
    #Build regex pattern
    $patString = 'const ' + $const + ' = "(?<path>.*?)";';
    $pattern = [regex] $patString;
    $result = $pattern.match($constants);
    #Add all constants that were matched to the consts array here for iteration
    #into the SCSS as a constObj defined above
    if($result.Length -gt 0){
        $constObjs += constObj($const,$result.Groups['path'].Captures[0].Value);
    }
}

################################################
#Open the sass appVars file and set app settings
################################################
$sassVarsContent = "";
$isFirst = 1;
Get-Content $sassVarsFile | foreach{
    if($isFirst -ne 1){
        $sassVarsContent += "`n";
    }
    else{
        $isFirst = 0;
    }
    $sassVarsContent += $_;
}
#Get rid of that last newline
$sassVarsContent = $sassVarsContent -replace "`n$";

foreach($const in $constObjs){
    $patString = '\$(?<var>' + $const.varName + '):\s*".*?";';
    $pattern = [regex] $patString;
    $newValue = '$' + $const.varName + ':"' + $const.varValue + '";';
    $result = $pattern.match($sassVarsContent);
    #If the variable is already in the list, update it
    if($result.Groups['var'].Captures[0].Value.Length -gt 0){
        $sassVarsContent = $sassVarsContent -replace $patString, $newValue;
    }
    #If the variable is not in the list, create it
    else{
        $sassVarsContent += "`n" + $newValue;
    }
}
$sassVarsContent;


#Write the new scss file
sc $sassVarsFile $sassVarsContent