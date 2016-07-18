<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午5:25
 */

namespace Message;


class Transaction extends AbstractMessage
{
    private $m_children = array();

    /**
     * @param Message $massage 子消息
     */
    public function addChild(Message $massage) {
        array_push($this->m_children, $massage);
    }

    public function hasChild() {
        return count($this->m_children) > 0;
    }
}