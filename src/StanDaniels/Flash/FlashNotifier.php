<?php
namespace StanDaniels\Flash;

use Illuminate\Support\Collection;

class FlashNotifier
{
    /**
     * The session writer.
     *
     * @var SessionStore
     */
    private $session;

    /**
     * Create a new flash notifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Flash an information message.
     *
     * @param  string $message
     * @return $this
     */
    public function info($message)
    {
        $this->message($message, 'info');

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string $message
     * @return $this
     */
    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string $message
     * @return $this
     */
    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string $message
     * @return $this
     */
    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string $message
     * @param  string $title
     * @param  string $level
     * @return $this
     */
    public function overlay($message, $title = 'Notice', $level = 'info')
    {
        $notification = new Collection([
            'message' => $message,
            'level' => $level,
            'overlay' => true,
            'title' => $title,
        ]);
        $this->push($notification);

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     * @param  array  $payload
     * @return $this
     */
    public function message($message, $level = 'info', $payload = [])
    {
        $notification = new Collection([
            'message' => $message,
            'level' => $level,
            'payload' => $payload,
        ]);
        $this->push($notification);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        $last = $this->pop();
        $last->put('important', true);
        $this->push($last);

        return $this;
    }

    /**
     * @return Collection[]
     */
    public function all()
    {
        return $this->session->pull('flash_notifications', []);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->session->get('flash_notifications', []));
    }

    /**
     * Get and remove the last item from the collection.
     * @return Collection
     */
    protected function pop()
    {
        $flashNotifications = $this->all();
        $last = \array_pop($flashNotifications);
        $this->session->flash('flash_notifications', $flashNotifications);

        return $last;
    }

    /**
     * @param Collection $notification
     */
    protected function push(Collection $notification)
    {
        $flashNotifications = $this->all();
        $flashNotifications[] = $notification;
        $this->session->flash('flash_notifications', $flashNotifications);
    }
}

