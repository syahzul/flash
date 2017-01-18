@foreach (flash()->all() as $message)
    @if ($message->has('overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message->get('title'),
            'body'       => $message->get('message'),
        ])
    @else
        <div class="alert
                    alert-{{ $message->get('level') }}
                    {{ $message->has('important') ? 'alert-important' : '' }}"
        >
            @if($message->has('important'))
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message->get('message') !!}
        </div>
    @endif
@endforeach
