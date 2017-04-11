<?php
use StanDaniels\Flash\FlashNotifier;
use Mockery as m;

class FlashTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var StanDaniels\Flash\SessionStore
     */
    protected $session;

    /**
     * @var StanDaniels\Flash\FlashNotifier
     */
    protected $flash;

    protected function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->session = m::mock('StanDaniels\Flash\SessionStore');
        $this->flash = new FlashNotifier($this->session);
    }

    /** @test */
    public function it_displays_default_flash_notifications()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Welcome Aboard',
            'level' => 'info',
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->message('Welcome Aboard');
    }

    /** @test */
    public function it_displays_important_flash_notifications()
    {
        $defaultMessage = \Illuminate\Support\Collection::make([
            'message' => 'Welcome Aboard',
            'level' => 'info',
            'payload' => [],
        ]);
        $importantMessage = \Illuminate\Support\Collection::make([
            'message' => 'Welcome Aboard',
            'level' => 'info',
            'important' => true,
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$defaultMessage]);
        $this->session->shouldReceive('pull')->once()->andReturn([$defaultMessage]);
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', []);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$importantMessage]);

        $this->flash->message('Welcome Aboard')->important();
    }

    /** @test */
    public function it_displays_info_flash_notifications()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Welcome Aboard',
            'level' => 'info',
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->info('Welcome Aboard');
    }

    /** @test */
    public function it_displays_success_flash_notifications()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Task completed',
            'level' => 'success',
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->success('Task completed');
    }

    /** @test */
    public function it_displays_error_flash_notifications()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Uh Oh',
            'level' => 'danger',
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->error('Uh Oh');
    }

    /** @test */
    public function it_displays_warning_flash_notifications()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Be careful!',
            'level' => 'warning',
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->warning('Be careful!');
    }

    /** @test */
    public function it_displays_flash_overlay_notifications()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Overlay Message',
            'title' => 'Notice',
            'level' => 'info',
            'overlay' => true,
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->overlay('Overlay Message');
    }

    /** @test */
    public function it_displays_flash_overlay_notifications_with_custom_level()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Overlay Message',
            'title' => 'Notice',
            'level' => 'danger',
            'overlay' => true,
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->overlay('Overlay Message', 'Notice', 'danger');
    }

    /** @test */
    public function it_displays_flash_overlay_notifications_with_custom_title()
    {
        $message = \Illuminate\Support\Collection::make([
            'message' => 'Overlay Message',
            'title' => 'For your information',
            'level' => 'info',
            'overlay' => true,
            'payload' => [],
        ]);
        $this->session->shouldReceive('pull')->once();
        $this->session->shouldReceive('flash')->once()->with('flash_notifications', [$message]);

        $this->flash->overlay('Overlay Message', 'For your information');
    }

}
