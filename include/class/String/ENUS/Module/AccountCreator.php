<?php
/**
 * Author: Ghost
 * Date: 9/24/13
 */
 
class String_ENUS_Module_AccountCreator {
    //Titles
    const TITLE_START = "Create an account";
    const TITLE_READY = "Your account is ready!";

    //Form fields
    const FIELD_EMAIL = "Email";
    const FIELD_PASSWORD = "Password";
    const FIELD_VERIFY_PASSWORD = "Verify Password";
    const FIELD_CREATE_ACCOUNT_SUBMIT = "Create Account";

    //Content
    //{0} in this case is a formatted anchor tag linking to the terms of service
    const CONTENT_START_ACCOUNT_DISCLAIMER = "By clicking \"Create Account\", you are agreeing to the {0}.";

    //{0} - Email address that the confirmation email was sent to
    const CONTENT_READY_BODY_1 = "We just sent a confirmation email to {0}.";
    const CONTENT_READY_BODY_2 = "To continue, check your email and follow the link provided to finalize the account creation process.";
}