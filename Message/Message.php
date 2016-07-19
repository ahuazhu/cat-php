<?php

/**
 *
 */
namespace Message;

interface Message
{
    const SUCCESS = "0";

    function addData($key, $value);

    function getData();

    function getType();

    function getName();

    function isComplete();

    function complete();

    function isSuccess();

    function setStatus($status);

    function getStatus();

    function getTimestamp();

}