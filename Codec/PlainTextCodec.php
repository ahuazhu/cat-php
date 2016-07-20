<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午5:30
 */

namespace Codec;


use Message\Event;
use Message\Transaction;
use Utils\TimeUtil;

class PlainTextCodec implements MessageCodec
{

    public function encode($messageTree)
    {
        $header = $this->encodeHeader($messageTree);
        $body = $this->encodeBody($messageTree);

        return $header . $body;
    }

    /**
     * @param $messageTree
     */
    public function encodeHeader($messageTree)
    {
        $header = $messageTree->getVersion() . "\t";
        $header .= $messageTree->getDomain() . "\t";
        $header .= $messageTree->getHostName() . "\t";
        $header .= $messageTree->getIpAddress() . "\t";
        $header .= $messageTree->getThreadGroupName() . "\t";
        $header .= $messageTree->getThreadId() . "\t";
        $header .= $messageTree->getThreadName() . "\t";
        $header .= $messageTree->getMessageId() . "\t";
        $header .= $messageTree->getParentMessageId() . "\t";
        $header .= $messageTree->getRootMessageId() . "\t";
        $header .= $messageTree->getSessionToken() . "\t";
        $header .= "\n";

        return $header;
    }

    private function encodeBody($messageTree)
    {
        return $this->encodeMessage($messageTree->getMessage());
    }

    public function encodeMessage($message)
    {

        if ($message instanceof Transaction) {
            $data = '';

            $transaction = $message;
            $children = $transaction->getChildren();

            if (count($children) == 0) {
                return $this->encodeLine($transaction, 'A', Policy::WITH_DURATION);
            } else {
                $data .= $this->encodeLine($transaction, 't', Policy::WITHOUT_STATUS);

                foreach ($children as $child) {
                    if ($child != null) {
                        $data .= $this->encodeMessage($child);
                    }
                }
                $data .= $this->encodeLine($transaction, 'T', Policy::WITH_DURATION);
            }

            return $data;
        } else if ($message instanceof Event) {
            return $this->encodeLine($message, 'E', Policy::DEFAULT_POLICY);
        } else {
            throw new \RuntimeException("Unsupported message type: ");
        }

    }

    private function encodeLine($message, $type, $policy)
    {
        $data = "";
        $data .= $type;


        if ($type == 't' && $message instanceof Transaction) {
            $duration = $message->getDurationInMillis();
            $data .= TimeUtil::format($message->getTimestampInMillis() + $duration) . "\t";
        } else {
            $data .= TimeUtil::format($message->getTimestampInMillis()) . "\t";
        }


        $data .= $message->getType() ."\t";
        $data .= $message->getName() ."\t";


        if ($policy != Policy::WITHOUT_STATUS) {

            $data .= $message->getStatus() . "\t";

            if ($policy == Policy::WITH_DURATION && $message instanceof Transaction) {
                $duration = $message->getDurationInMicros();
                $data .= $duration . "us" . "\t";
            }


            $data .= $message->getData();
            $data .= "\t";
        }

        $data .= "\n";

        return $data;
    }

}

interface Policy
{
    const DEFAULT_POLICY = 0;
    const WITH_DURATION = 1;
    const WITHOUT_STATUS = 2;
}