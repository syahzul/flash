<?php
if ( ! function_exists('flash')) {

    /**
     * Arrange for a flash message.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return \StanDaniels\Flash\FlashNotifier
     */
    function flash($message = null, $level = 'info', $payload = [])
    {
        /** @var \StanDaniels\Flash\FlashNotifier $notifier */
        $notifier = app('flash');

        if ( ! is_null($message)) {
            return $notifier->message($message, $level, $payload);
        }

        return $notifier;
    }

}
