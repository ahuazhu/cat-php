<?php

namespace Message;

abstract class AbstractMessage implements Message
{
    private $m_type;

    private $m_name;

    protected $m_status = "unset";

    private $m_timestampInMillis;

    private $m_data;

    private $m_completed;


}