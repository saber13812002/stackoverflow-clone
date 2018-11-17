<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @foreach($answers as $answer)
                    <div class="media">

                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful?"
                               class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('vote-up-answer-{{ $answer->id }}').submit()"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form style="display: none"
                                  id="vote-up-answer-{{ $answer->id }}"
                                  action="{{ route('answers.vote', $answer->id) }}"
                                  method="POST"
                            >
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count">{{ $answer->votes_count }}</span>

                            <a title="This answer is not useful?"
                               class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{ $answer->id }}').submit()"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form style="display: none"
                                  id="vote-down-answer-{{ $answer->id }}"
                                  action="{{ route('answers.vote', $answer->id) }}"
                                  method="POST"
                            >
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            @can('accept', $answer)
                                <a
                                    title="Mark this answer as best answer"
                                    class="{{ $answer->status }} mt-2 answered-accepted-{{ $answer->id }}"
                                    onclick="event.preventDefault(); document.getElementById('answered-accepted-{{ $answer->id }}').submit()"
                                >
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                <form id="answered-accepted-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="POST" style="display: none">
                                    @csrf
                                </form>
                            @else
                                @if($answer->isBest())
                                    <a
                                        title="The question owner accepted this answer as best answer"
                                        class="{{ $answer->status }} mt-2 answered-accepted-{{ $answer->id }}"
                                    >
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>

                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onClick="return confirm('Are you sure')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
