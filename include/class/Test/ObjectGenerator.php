<?php
/**
 * Author: Ghost
 * Date: 8/14/13
 */
 
class Test_ObjectGenerator {
    private $types;
    private $firstNames;
    private $lastNames;
    private $languages;
    private $streets;
    private $cities;
    private $states;
    private $countries;
    private $placeNames;
    private $eventNames;
    private $topics;
    private $difficulties;

    public function __construct(){
        $this->firstNames = array("John","Juan","Irene","Melina","Julieta","Paola","Jose","Anita","Leandra","Leonardo","James","Kevin","Patricio","Patricia","Alejandro");
        $this->lastNames = array("Miller","Pelotudo","Jackson","Levalle","Esponja","Jaime","Josero","Juanita","Mison","Perón");
        $this->types = array("Milonga","Lesson","Practica","Show");
        $this->languages = array("ESAR","ENUS");
        $this->streets = array("1st Avenue","45th Street","Avenida Pellegrini","9 de Julio","Boylston Drive","Mitre","Paraguay");
        $this->cities = array("Seattle","Buenos Aires","Rosario","Portland","New York City","Bellingham","San Francisco");
        $this->states = array("WA","OR","CA","Capital Federal","Santa Fe","New York");
        $this->countries = array("United State","Argentina");
        $this->placeNames = array("Club Sur","Om Culture","China Harbor","Downtown Bar","Mano a Mano","El Levante");
        $this->eventNames = array("El Faro","Purple Haze","China Harbor","Roja","Cafe de la Flor","Los Zarpados","Cachete","Bailarines","La Monita");
        $this->topics = array("Ochos","Crosses","Ochos and Crosses","Caminata","Pasos Chiquitos","Musicality","Ganchos","Boleos","Sistemas de Baile Avanzadas","Walking slowly","Dancing to the Music","El Abrazo");
        $this->difficulties = array(String_String::getString("EVENT_DIFFICULTY_BEGINNER"),String_String::getString("EVENT_DIFFICULTY_INTERMEDIATE"),String_String::getString("EVENT_DIFFICULTY_ADVANCED"));
        $this->descriptions = array(
            "Consectetuer in refero vel gemino pala pagus in. Obruo pecus mauris. Camur wisi vel suscipere et quod consequat tamen. Eum jumentum ne nisl quod pecus vel damnum laoreet zelus brevitas imputo. Ullamcorper quidem feugait foras.",
            "Vel suscipere probo tamen dolore tum singularis quidem nisl iriure. Enim mauris gilvus importunus transverbero decet diam vicis. Velit quidem uxor nullus dignissim facilisi eum exputo. Hendrerit suscipit decet comis.",
            "Abico iriure luptatum autem transverbero humo typicus. Sed eum pneum loquor capto praemitto tum nibh eros iriure. Ille ea nobis cui ea quia. Nostrud eu roto quod jus decet modo esse ea ille. Genitus causa brevitas importunus praemitto commodo ullamcorper. Ratis commodo fatua aptent ideo feugiat modo nostrud nulla si nimis ut.",
            "Quis duis causa lucidus rusticus haero vero transverbero neque velit zelus tation. Duis facilisis abdo mauris indoles suscipit fere esse."
        );
    }



    public function getRandomEvent($type = null){
        $data = array();
        $startHour = rand(18,22);
        $halfHour = rand(0,1) ? "00" : "30";
        $startTime = $startHour . ":" . $halfHour . ":00";
        $description = $this->descriptions[rand(0,3)];
        $e = null;
        $typeNum = null;

        $data['name'] = $this->eventNames[rand(0,count($this->eventNames) - 1)];
        $data['price'] = rand(5,50);
        $data['topic'] = $this->topics[rand(0,count($this->topics) - 1)];
        $data['id'] = $this->getRandomID();
        $data['parent_id'] = $this->getRandomID();
        $data['organizer_id'] = $this->getRandomID();
        $data['confirmed'] = rand(0,1);
        $data['difficulty'] = $this->difficulties[rand(0,count($this->difficulties) - 1)];
        $data['date_start'] = strtotime("today " . $startTime);
        $data['date_end'] = strtotime("today " . $startTime . " + 4 hours");
        $data['min_age'] = rand(0,1) ? 0 : 18;
        $data['repeat'] = "weekly";
        $data['description'] = $description;

        $location = $this->getRandomLocation();
        $numDJs = rand(1,2);
        $numInstructors = rand(1,2);
        $numArtists = rand(2,6);
        switch($type){
            case "milonga":
                $typeNum = 0;
                break;
            case "lesson":
                $typeNum = 1;
                break;
            case "practica":
                $typeNum = 2;
                break;
            case "show":
                $typeNum = 3;
                break;
            default:
                $typeNum = rand(0,3);
                break;
        }

        switch($typeNum){
            case 0:
                $djs = array();
                for($i = 0; $i < $numDJs; $i++){
                    array_push($djs,$this->getRandomPerson());
                }
                $e = new Event_Milonga($data,$location,$djs);
                break;
            case 1:
                $instructors = array();
                for($i = 0; $i < $numInstructors; $i++){
                    array_push($instructors,$this->getRandomPerson());
                }
                $e = new Event_Lesson($data, $location, $instructors);
                break;
            case 2:
                $instructors = array();
                $djs = array();
                for($i = 0; $i < $numDJs; $i++){
                    array_push($djs,$this->getRandomPerson());
                }
                for($i = 0; $i < $numInstructors; $i++){
                    array_push($instructors,$this->getRandomPerson());
                }
                $e = new Event_Practica($data, $location, $instructors, $djs);
                break;
            case 3:
                $artists = array();
                for($i = 0; $i < $numArtists; $i++){
                    array_push($artists,$this->getRandomPerson());
                }
                $e = new Event_Show($data, $location, $artists);
                break;
        }
        return $e;
    }



    public function getRandomPerson(){
        //Randomize so that some "person" objects are users. One in three will not be a user.
        $user = rand(0,3);
        if($user > 0){
            return $this->getRandomUser();
        }

        $data = array();
        $data['first_name'] = $this->getRandomFirstName();
        $data['last_name'] = $this->getRandomLastName();
        $data['person_id'] = $this->getRandomID();
        $data['email'] = $data['first_name'] . "." . $data['last_name'] . "@gmail.com";

        return new Person_Person($data);
    }



    public function getRandomUser(){
        $randLang = rand(0,1);

        $data = array();
        $data['first_name'] = $this->getRandomFirstName();
        $data['last_name'] = $this->getRandomLastName();
        $data['person_id'] = $this->getRandomID();
        $data['user_id'] = $this->getRandomID();
        $data['email'] = $data['first_name'] . "." . $data['last_name'] . "@gmail.com";
        $data['language'] = $this->languages[$randLang];

        return new Person_User($data);
    }



    public function getRandomFullName(){
        return $this->getRandomFirstName() . " " . $this->getRandomLastName();
    }



    public function getRandomFirstName(){
        return $this->firstNames[rand(0,count($this->firstNames) - 1)];
    }



    public function getRandomLastName(){
            return $this->lastNames[rand(0,count($this->lastNames) - 1)];
    }



    public function getRandomID(){
        return rand(1000000,99999999999);
    }



    public function getRandomLocation(){
        $streetNumber = rand(100,9999);
        $address = array();
        $address['name'] = $this->placeNames[rand(0,count($this->placeNames)-1)];
        $address['address'] = $streetNumber . " " . $this->streets[rand(0,count($this->streets)-1)];
        $address['city'] = $this->cities[rand(0,count($this->cities)-1)];
        $address['state'] = $this->states[rand(0,count($this->states)-1)];
        $address['zip'] = rand(10001,99999) . "";
        $address['country'] = $this->countries[rand(0,count($this->countries)-1)];
        return new Location($address);
    }
}