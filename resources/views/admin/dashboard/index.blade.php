@extends('layouts.admin')

@push('styles')
<style>
  /* Animations kekal */
  .fade-in { animation: fadeIn 0.6s ease-in-out; }
  @keyframes fadeIn { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }

  .counter { animation: countUp 1s ease-out forwards; }
  @keyframes countUp { from { transform:scale(0.92); opacity:0;} to { transform:scale(1); opacity:1;} }

  .progress-animate .progress-bar { width:0; animation: fillProgress 1.5s ease-out forwards; }
  @keyframes fillProgress { to { width: var(--progress-width); } }

  .hover-lift { transition: transform .25s ease, box-shadow .25s ease; }
  .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 1rem 1.25rem rgba(0,0,0,.06), 0 .5rem .5rem rgba(0,0,0,.04); }

  /* Gradien kecil untuk cards statistik */
  .grad-blue   { background: linear-gradient(90deg, #3b82f6, #2563eb); }
  .grad-green  { background: linear-gradient(90deg, #22c55e, #16a34a); }
  .grad-purple { background: linear-gradient(90deg, #a855f7, #7c3aed); }
  .grad-orange { background: linear-gradient(90deg, #f59e0b, #ea580c); }
</style>
@endpush

@section('content')
<div class="py-4" style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); min-height: 100vh;">
  <div class="container">

    {{-- Header --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
      <div class="mb-3 mb-md-0">
        <h1 class="h2 fw-bold d-flex align-items-center mb-1">
          <svg width="40" height="40" class="me-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
          Admin Dashboard
        </h1>
        <p class="text-muted">Blog statistics and analytics using Eloquent Collections</p>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-body py-2 px-3">
          <div class="small text-muted">Last updated</div>
          <div class="fw-semibold">{{ now()->format('M d, Y H:i') }}</div>
        </div>
      </div>
    </div>

    {{-- Overview Cards --}}
    <div class="row g-3 g-md-4 mb-4">
      <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white border-0 grad-blue hover-lift fade-in">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small opacity-75">Total Posts</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['total_posts'] }}</div>
                <div class="small opacity-75">All published content</div>
              </div>
              <div class="bg-white bg-opacity-25 rounded-3 p-2">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor" class="text-white">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                  <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3h3v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white border-0 grad-green hover-lift fade-in" style="animation-delay:.1s;">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small opacity-75">Total Comments</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['total_comments'] }}</div>
                <div class="small opacity-75">Community engagement</div>
              </div>
              <div class="bg-white bg-opacity-25 rounded-3 p-2">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor" class="text-white">
                  <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white border-0 grad-purple hover-lift fade-in" style="animation-delay:.2s;">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small opacity-75">Total Users</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['total_users'] }}</div>
                <div class="small opacity-75">Registered members</div>
              </div>
              <div class="bg-white bg-opacity-25 rounded-3 p-2">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor" class="text-white">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white border-0 grad-orange hover-lift fade-in" style="animation-delay:.3s;">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small opacity-75">Posts This Month</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['posts_this_month'] }}</div>
                <div class="small opacity-75">Recent activity</div>
              </div>
              <div class="bg-white bg-opacity-25 rounded-3 p-2">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor" class="text-white">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Main grid --}}
    <div class="row g-4">

      {{-- Posts by Category --}}
      <div class="col-12 col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="card-title mb-0 d-flex align-items-center">
                <span class="me-2 rounded-pill" style="display:inline-block;width:6px;height:24px;background:#3b82f6;"></span>
                Posts by Category
              </h5>
              <span class="badge bg-primary-subtle text-primary">
                {{ $statistics['posts']['by_category']->count() }} categories
              </span>
            </div>

            @if($statistics['posts']['by_category']->count() > 0)
              <div class="vstack gap-2">
                @foreach($statistics['posts']['by_category'] as $category => $count)
                  <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light">
                    <div class="d-flex align-items-center">
                      <span class="me-2 rounded-circle" style="display:inline-block;width:10px;height:10px;background:#3b82f6;"></span>
                      <span class="fw-medium">{{ $category }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2" style="min-width:280px;">
                      <span class="badge bg-primary">{{ $count }}</span>
                      <div class="progress flex-grow-1" style="height:8px;">
                        @php $pct = $statistics['posts']['total'] ? ($count / $statistics['posts']['total'])*100 : 0; @endphp
                        <div class="progress-bar" role="progressbar" style="width: {{ $pct }}%"></div>
                      </div>
                      <span class="text-muted small">{{ round($pct,1) }}%</span>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center py-5 text-muted">
                <svg width="48" height="48" class="mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <div>No categories found.</div>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Monthly Posts Trend --}}
      <div class="col-12 col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="card-title mb-0 d-flex align-items-center">
                <span class="me-2 rounded-pill" style="display:inline-block;width:6px;height:24px;background:#16a34a;"></span>
                Monthly Posts Trend
              </h5>
              <span class="badge bg-success-subtle text-success">Last 6 months</span>
            </div>

            @if($statistics['posts']['monthly_posts']->count() > 0)
              <div class="vstack gap-2">
                @foreach($statistics['posts']['monthly_posts'] as $month => $count)
                  @php
                    $max = max($statistics['posts']['monthly_posts']->max(), 1);
                    $pct = ($count / $max) * 100;
                    $share = ($count / max($statistics['posts']['monthly_posts']->sum(),1)) * 100;
                  @endphp
                  <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light">
                    <div class="d-flex align-items-center">
                      <span class="me-2 rounded-circle" style="display:inline-block;width:10px;height:10px;background:#16a34a;"></span>
                      <span class="fw-medium">{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2" style="min-width:280px;">
                      <span class="badge bg-success">{{ $count }}</span>
                      <div class="progress flex-grow-1 progress-animate" style="height:8px; --progress-width: {{ $pct }}%;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pct }}%"></div>
                      </div>
                      <span class="text-muted small">{{ round($share,1) }}%</span>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center py-5 text-muted">
                <svg width="48" height="48" class="mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <div>No monthly data found.</div>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Content Analysis --}}
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title mb-3">Content Analysis</h5>

            <div class="row g-3">
              <div class="col-12 col-md-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                  <span class="text-muted">Average Word Count:</span>
                  <span class="fw-semibold">{{ $statistics['content_analysis']['average_word_count'] }} words</span>
                </div>
              </div>

              <div class="col-12 col-md-8">
                <h6 class="fw-medium text-muted mb-2">Longest Posts:</h6>
                <ul class="list-group list-group-flush">
                  @foreach($statistics['content_analysis']['longest_posts'] as $post)
                    <li class="list-group-item px-0">
                      <a class="link-primary" href="{{ route('posts.show', ['slug' => $post['slug']]) }}">
                        {{ \Str::limit($post['title'], 40) }}
                      </a>
                      <span class="text-muted">({{ $post['word_count'] }} words)</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>

      {{-- Engagement Statistics --}}
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title mb-3">Engagement Statistics</h5>

            <div class="row g-3">
              <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                  <span class="text-muted">Comments This Month:</span>
                  <span class="fw-semibold">{{ $statistics['engagement']['comments_this_month'] }}</span>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                  <span class="text-muted">Avg Comments per Post:</span>
                  <span class="fw-semibold">{{ $statistics['engagement']['average_comments_per_post'] }}</span>
                </div>
              </div>
            </div>

            <div class="mt-3">
              <h6 class="fw-medium text-muted mb-2">Most Commented Posts:</h6>
              <ul class="list-group">
                @foreach($statistics['engagement']['posts_with_most_comments'] as $post)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a class="link-primary" href="{{ route('posts.show', $post['slug']) }}">
                      {{ \Str::limit($post['title'], 30) }}
                    </a>
                    <span class="badge text-bg-success">{{ $post['comments_count'] }} comments</span>
                  </li>
                @endforeach
              </ul>
            </div>

          </div>
        </div>
      </div>

      {{-- Recent Posts --}}
      <div class="col-12 col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title mb-3">Recent Posts</h5>

            @if($statistics['posts']['recent_posts']->count() > 0)
              <ul class="list-group list-group-flush">
                @foreach($statistics['posts']['recent_posts'] as $post)
                  <li class="list-group-item px-0">
                    <a href="{{ route('posts.show', $post->slug) }}" class="fw-medium link-primary">
                      {{ \Str::limit($post->title, 50) }}
                    </a>
                    <div class="small text-muted mt-1">
                      <span>by {{ $post->user->name ?? 'Unknown' }}</span>
                      <span class="mx-2">•</span>
                      <span>{{ $post->created_at->diffForHumans() }}</span>
                      <span class="mx-2">•</span>
                      <span>{{ $post->comments->count() }} comments</span>
                    </div>
                  </li>
                @endforeach
              </ul>
            @else
              <div class="text-muted">No recent posts found.</div>
            @endif
          </div>
        </div>
      </div>

      {{-- Recent Comments --}}
      <div class="col-12 col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title mb-3">Recent Comments</h5>

            @if($statistics['engagement']['recent_comments']->count() > 0)
              <div class="overflow-auto" style="max-height: 18rem;">
                <ul class="list-group list-group-flush">
                  @foreach($statistics['engagement']['recent_comments'] as $comment)
                    <li class="list-group-item px-0">
                      <div class="small">
                        <span class="fw-semibold">{{ $comment['author'] }}</span>
                        <span class="text-muted">commented on</span>
                        <a href="{{ route('posts.show', $comment['post_slug']) }}" class="link-primary">
                          {{ \Str::limit($comment['post_title'], 30) }}
                        </a>
                      </div>
                      <div class="small text-muted mt-1">{{ $comment['content'] }}</div>
                      <div class="text-muted" style="font-size:.8rem;">{{ $comment['created_at'] }}</div>
                    </li>
                  @endforeach
                </ul>
              </div>
            @else
              <div class="text-muted">No recent comments found.</div>
            @endif
          </div>
        </div>
      </div>

    </div> {{-- /row --}}

    {{-- Top Contributors --}}
    <div class="card shadow-sm mt-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0 d-flex align-items-center">
            <span class="me-2 rounded-pill" style="display:inline-block;width:6px;height:24px;background:#7c3aed;"></span>
            Most Active Authors
          </h5>
          <span class="badge bg-purple text-bg-light border" style="--bs-badge-color:#7c3aed;">Top Contributors</span>
        </div>

        @if($statistics['activity']['most_active_authors']->count() > 0)
          <div class="row g-3">
            @foreach($statistics['activity']['most_active_authors'] as $index => $author)
              <div class="col-12 col-md-4 col-xl-2">
                <div class="text-center p-3 border rounded-4 hover-lift h-100 position-relative">
                  @if($index === 0)
                    <div class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-warning text-dark">🏆</div>
                  @elseif($index === 1)
                    <div class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-secondary">2</div>
                  @elseif($index === 2)
                    <div class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-orange">3</div>
                  @endif

                  <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold mb-2"
                       style="width:64px;height:64px;background: linear-gradient(90deg,#a855f7,#7c3aed);">
                    {{ substr($author['name'], 0, 1) }}
                  </div>
                  <div class="fw-semibold">{{ $author['name'] }}</div>
                  <div class="display-6 fw-bold text-primary my-1">{{ $author['posts_count'] }}</div>
                  <div class="small text-muted mb-2">posts published</div>

                  @if($author['latest_post'])
                    <div class="bg-light rounded-3 p-2 small">
                      <div class="text-muted fw-medium">Latest:</div>
                      <div class="text-truncate">{{ \Str::limit($author['latest_post'], 25) }}</div>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center text-muted py-5">
            <svg width="56" height="56" class="mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <div class="fs-5">No active authors found.</div>
          </div>
        @endif
      </div>
    </div>

  </div> {{-- /container --}}
</div>
@endsection
