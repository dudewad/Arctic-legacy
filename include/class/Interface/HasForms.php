<?php
/**
 * Author: Ghost
 * Date: 2/21/14
 *
 * Controllers with forms must contain their own set of validation methods, but must also contain a
 * getSubmissionErrors() method that allows for callers that use those form submission validators to also access errors
 */
 
interface Interface_HasForms {
    /**
     * Should access and return the objects private or protected submissionErrors array
     *
     * @return array    An array of Exception_SecurityInputValidatorException objects defining the errors in the
     *                  form submission validation
     */
    public static function getValidationErrors();



    /**
     * Returns true if there were errors during validation of the input
     *
     * @return boolean
     */
    public static function hasValidationErrors();



    /**
     * Sets a validation error when one occurs
     *
     * @param $e    Exception   REQUIRED    The error that occurred in validation
     */
    public static function setValidationError($e);


    /**
     * Takes a stdClass object and sets it on form submission. This object contains data that was relevant to the
     * previous submission such as an email address that will be used in the next flow, etc.
     *
     * @param $data stdClass    REQUIRED        The stdClass object containing any relevant data on the previous
     *                                          submission as parameters (key/val)
     */
    public static function setSubmissionData($data);



    /**
     * Retrieves a stdClass object previously set by setSubmissionData(). This object contains data that was
     * relevant to the previous submission such as an email address that will be used in the next flow, etc.
     *
     * @return stdClass    The stdClass object containing any relevant data on the previous
     *                     submission as parameters (key/val)
     */
    public static function getSubmissionData();



    /**
     * Clears the local set of validation errors
     */
    public static function clearValidationErrors();
}