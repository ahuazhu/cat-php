<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午10:59
 */

namespace Message;


interface MessageManager
{
    public function add($message);

    /**
     * Be triggered when a transaction ends, whatever it's the root transaction or nested transaction. However, if it's
     * the root transaction then it will be flushed to back-end CAT server asynchronously.
     * <p>
     *
     * @param transaction
     */
    public function end(Transaction $transaction);

    /**
     * Get peek transaction for current thread.
     *
     * @return peek transaction for current thread, null if no transaction there.
     */
    public function getPeekTransaction();

    /**
     * Get thread local message information.
     *
     * @return message tree, null means current thread is not setup correctly.
     */
    public function getThreadLocalMessageTree();

    /**
     * Check if the thread context is setup or not.
     *
     * @return true if the thread context is setup, false otherwise
     */
    public function hasContext();


    /**
     * Do cleanup for current thread environment in order to release resources in thread local objects.
     */
    public function reset();


    /**
     * Do setup for current thread environment in order to prepare thread local objects.
     */
    public function setup();

    /**
     * Be triggered when a new transaction starts, whatever it's the root transaction or nested transaction.
     *
     * @param transaction
     * @param forked
     */
    public function start(Transaction $transaction);


    /**
     * get domain
     *
     */
    public function getDomain();
}