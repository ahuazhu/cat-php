<?php

/**
 *
 */
namespace Message;

interface Message
{
    const SUCCESS = "0";

    public function addData($key, $value);

    public function getData();

    public function getType();

    public function getName();

    public function isComplete();

    public function complete();

    public function isSuccess();

    public function setStatus($status);

    public function getStatus();

    public function getTimestampInMillis();

}