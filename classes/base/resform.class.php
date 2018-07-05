<?php
class resForm {
  private $errors = [];
  private $errorsCount = 0;
  private $data;

  function addError($string) {
    $this->errors[] = trim($string);
    $this->errorsCount++;

    return $this;
  }

  function getErrorsCount() {
    return $this->errorsCount;
  }

  function getErrors() {
    if($this->errorsCount > 0)
      return $this->errors;

    return false;
  }

  function isSuccess() {
    if($this->errorsCount == 0)
      return true;

    return false;
  }

  function setData($data) {
    $this->data = $data;
    return $this;
  }

  function getData() {
    return $this->data;
  }
}