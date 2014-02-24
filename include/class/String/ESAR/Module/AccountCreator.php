<?php
/**
 * Author: Ghost
 * Date: 9/24/13
 */
 
class String_ESAR_Module_AccountCreator {
    //Titles
    const TITLE_START = "Crear una cuenta";
    const TITLE_READY = "Tu cuenta esta lista!";

    //Form fields
    const FIELD_EMAIL = "Email";
    const FIELD_PASSWORD = "Contraseña";
    const FIELD_VERIFY_PASSWORD = "Verificar contraseña";
    const FIELD_CREATE_ACCOUNT_SUBMIT = "Crear cuenta";

    //Content
    //{0} - Formatted anchor tag linking to the terms of service
    const CONTENT_START_ACCOUNT_DISCLAIMER = "Hacer clic en \"Crear cuenta\" sifnifica que estás de acuerdo con la {0}.";

    //{0} - Email address that the confirmation email was sent to
    const CONTENT_READY_BODY_1 = "Acabamos de enviar un correo electrónico de confirmación a {0}.";
    const CONTENT_READY_BODY_2 = "Para continuar, chequeá tu correo electrónico y hacé clic en el link para finalizar los trámites de creación de cuenta.";
}