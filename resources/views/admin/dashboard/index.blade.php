@extends('layouts.admin')

@push('styles')
<style>
  .fade-in { animation: fadeIn 0.6s ease-in-out; }
  @keyframes fadeIn { from {opacity:0; transform:translateY(20px)} to {opacity:1; transform:translateY(0)} }
  .counter { animation: countUp 1s ease-out forwards; }
  @keyframes countUp { from {transform:scale(.9); opacity:0} to {transform:scale(1); opacity:1} }
  .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04); }
  .max-h-64 { max-height: 16rem; }
</style>
@endpush

@section('content')
<div class="bg-light min-vh-100">
  <div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <h1 class="h2 fw-bold text-dark d-flex align-items-center mb-1">
            <i class="bi bi-speedometer2 me-2 text-primary fs-1"></i>
            Admin Dashboard
          </h1>
          <p class="text-muted mb-0">Blog statistics and analytics using Eloquent Collections</p>
        </div>

        <div class="card shadow-sm border-0">
          <div class="card-body py-2 px-3">
            <div class="small text-muted">Last updated</div>
            <div class="fw-semibold">{{ now()->format('M d, Y H:i') }}</div>
          </div>
        </div>
      </div>
    </div>

    {{-- Overview Cards --}}
    <div class="row g-3 mb-4">
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-primary border-0 shadow hover-lift fade-in">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small text-white-50">Total Posts</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['total_posts'] }}</div>
                <div class="small text-white-50">All published content</div>
              </div>
              <div class="bg-white bg-opacity-25 p-2 rounded">
                <i class="bi bi-file-earmark-text fs-3 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-success border-0 shadow hover-lift fade-in" style="animation-delay:.1s">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small text-white-50">Total Comments</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['total_comments'] }}</div>
                <div class="small text-white-50">Community engagement</div>
              </div>
              <div class="bg-white bg-opacity-25 p-2 rounded">
                <i class="bi bi-chat-dots fs-3 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-secondary border-0 shadow hover-lift fade-in" style="animation-delay:.2s">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small text-white-50">Total Users</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['total_users'] }}</div>
                <div class="small text-white-50">Registered members</div>
              </div>
              <div class="bg-white bg-opacity-25 p-2 rounded">
                <i class="bi bi-people fs-3 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white border-0 shadow hover-lift fade-in" style="animation-delay:.3s; background:#fd7e14;">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="small text-white-50">Posts This Month</div>
                <div class="display-6 fw-bold counter">{{ $statistics['overview']['posts_this_month'] }}</div>
                <div class="small text-white-50">Recent activity</div>
              </div>
              <div class="bg-white bg-opacity-25 p-2 rounded">
                <i class="bi bi-calendar2-week fs-3 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Main Grid --}}
    <div class="row g-4">

      {{-- Posts by Category --}}
      <div class="col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="h6 mb-0 d-flex align-items-center">
              <span class="me-2 d-inline-block rounded-pill" style="width:6px; height:24px; background:#0d6efd;"></span>
              Posts by Category
            </h2>
            <span class="badge rounded-pill text-bg-primary">
              {{ $statistics['posts']['by_category']->count() }} categories
            </span>
          </div>
          <div class="card-body">
            @if($statistics['posts']['by_category']->count() > 0)
              <div class="vstack gap-3">
                @foreach($statistics['posts']['by_category'] as $category => $count)
                  @php
                    $pct = $statistics['posts']['total'] ? ($count / $statistics['posts']['total']) * 100 : 0;
                  @endphp
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                      <span class="rounded-circle me-2" style="width:10px; height:10px; background:#0d6efd;"></span>
                      <span class="fw-medium">{{ $category }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-3" style="min-width:260px;">
                      <span class="badge text-bg-primary">{{ $count }}</span>
                      <div class="progress flex-grow-1" style="height:8px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $pct }}%"></div>
                      </div>
                      <small class="text-muted">{{ round($pct,1) }}%</small>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center text-muted py-5">
                <i class="bi bi-folder-x mb-2 text-secondary fs-1 d-block"></i>
                <div>No categories found.</div>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Monthly Posts --}}
      <div class="col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="h6 mb-0 d-flex align-items-center">
              <span class="me-2 d-inline-block rounded-pill" style="width:6px; height:24px; background:#198754;"></span>
              Monthly Posts Trend
            </h2>
            <span class="badge rounded-pill text-bg-success">Last 6 months</span>
          </div>
          <div class="card-body">
            @if($statistics['posts']['monthly_posts']->count() > 0)
              <div class="vstack gap-3">
                @foreach($statistics['posts']['monthly_posts'] as $month => $count)
                  @php
                    $max = max(1, $statistics['posts']['monthly_posts']->max());
                    $pct = ($count / $max) * 100;
                    $sum = max(1, $statistics['posts']['monthly_posts']->sum());
                    $share = round(($count / $sum) * 100, 1);
                  @endphp
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                      <span class="rounded-circle me-2" style="width:10px; height:10px; background:#198754;"></span>
                      <span class="fw-medium">{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-3" style="min-width:260px;">
                      <span class="badge text-bg-success">{{ $count }}</span>
                      <div class="progress flex-grow-1" style="height:8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pct }}%"></div>
                      </div>
                      <small class="text-muted">{{ $share }}%</small>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center text-muted py-5">
                <i class="bi bi-bar-chart mb-2 text-secondary fs-1 d-block"></i>
                <div>No monthly data found.</div>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Content Analysis --}}
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-0">
            <h2 class="h6 mb-0">Content Analysis</h2>
          </div>
          <div class="card-body">
            <div class="mb-3 pb-2 border-bottom">
              <span class="text-muted me-2">Average Word Count:</span>
              <span class="fw-semibold">{{ $statistics['content_analysis']['average_word_count'] }} words</span>
            </div>

            <div>
              <h6 class="fw-semibold text-muted">Longest Posts:</h6>
              <div class="vstack gap-2 mt-2">
                @foreach($statistics['content_analysis']['longest_posts'] as $post)
                  <div class="small">
                    <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}" class="link-primary text-decoration-none">
                      {{ \Str::limit($post['title'], 40) }}
                    </a>
                    <span class="text-muted">({{ $post['word_count'] }} words)</span>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Engagement Stats --}}
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-0">
            <h2 class="h6 mb-0">Engagement Statistics</h2>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
              <span class="text-muted">Comments This Month:</span>
              <span class="fw-semibold">{{ $statistics['engagement']['comments_this_month'] }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
              <span class="text-muted">Avg Comments per Post:</span>
              <span class="fw-semibold">{{ $statistics['engagement']['average_comments_per_post'] }}</span>
            </div>

            <h6 class="fw-semibold text-muted mt-3">Most Commented Posts:</h6>
            <div class="vstack gap-2 mt-2">
              @foreach($statistics['engagement']['posts_with_most_comments'] as $post)
                <div class="small d-flex justify-content-between align-items-center">
                  <a href="{{ route('posts.show', $post['slug']) }}" class="link-primary text-decoration-none">
                    {{ \Str::limit($post['title'], 30) }}
                  </a>
                  <span class="badge text-bg-success">{{ $post['comments_count'] }} comments</span>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      {{-- Recent Posts --}}
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-0">
            <h2 class="h6 mb-0">Recent Posts</h2>
          </div>
          <div class="card-body">
            @if($statistics['posts']['recent_posts']->count() > 0)
              <div class="vstack gap-3">
                @foreach($statistics['posts']['recent_posts'] as $post)
                  <div class="pb-2 border-bottom">
                    <a href="{{ route('posts.show', $post->slug) }}" class="fw-semibold link-primary text-decoration-none">
                      {{ \Str::limit($post->title, 50) }}
                    </a>
                    <div class="small text-muted mt-1">
                      <span>by {{ $post->user->name ?? 'Unknown' }}</span>
                      <span class="mx-2">•</span>
                      <span>{{ $post->created_at->diffForHumans() }}</span>
                      <span class="mx-2">•</span>
                      <span>{{ $post->comments->count() }} comments</span>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-muted">No recent posts found.</div>
            @endif
          </div>
        </div>
      </div>

      {{-- Recent Comments --}}
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-0">
            <h2 class="h6 mb-0">Recent Comments</h2>
          </div>
          <div class="card-body">
            @if($statistics['engagement']['recent_comments']->count() > 0)
              <div class="vstack gap-3 max-h-64 overflow-auto">
                @foreach($statistics['engagement']['recent_comments'] as $comment)
                  <div class="pb-2 border-bottom">
                    <div class="small">
                      <span class="fw-semibold">{{ $comment['author'] }}</span>
                      <span class="text-muted">commented on</span>
                      <a href="{{ route('posts.show', $comment['post_slug']) }}" class="link-primary text-decoration-none">
                        {{ \Str::limit($comment['post_title'], 30) }}
                      </a>
                    </div>
                    <p class="small mb-1 mt-1">{{ $comment['content'] }}</p>
                    <div class="text-muted small">{{ $comment['created_at'] }}</div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-muted">No recent comments found.</div>
            @endif
          </div>
        </div>
      </div>

    </div>{{-- /row --}}

    {{-- Top Contributors --}}
    <div class="card shadow-sm mt-4">
      <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h2 class="h6 mb-0 d-flex align-items-center">
          <span class="me-2 d-inline-block rounded-pill" style="width:6px; height:24px; background:#6f42c1;"></span>
          Most Active Authors
        </h2>
        <span class="badge rounded-pill" style="background:#efe7ff; color:#6f42c1;">Top Contributors</span>
      </div>
      <div class="card-body">
        @if($statistics['activity']['most_active_authors']->count() > 0)
          <div class="row g-3">
            @foreach($statistics['activity']['most_active_authors'] as $index => $author)
              <div class="col-12 col-md-4 col-lg-2">
                <div class="text-center p-3 border rounded-4 h-100 hover-lift">
                  <div class="position-relative d-inline-block">
                    @if($index === 0)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">🏆</span>
                    @elseif($index === 1)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">2</span>
                    @elseif($index === 2)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">3</span>
                    @endif
                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-2 text-white fw-bold"
                         style="width:64px; height:64px; background:#6f42c1;">
                      {{ substr($author['name'], 0, 1) }}
                    </div>
                  </div>
                  <div class="fw-semibold">{{ $author['name'] }}</div>
                  <div class="display-6 fw-bold" style="color:#6f42c1">{{ $author['posts_count'] }}</div>
                  <div class="small text-muted mb-2">posts published</div>
                  @if($author['latest_post'])
                    <div class="bg-light rounded-3 p-2">
                      <div class="small fw-semibold text-muted">Latest:</div>
                      <div class="small text-muted">{{ \Str::limit($author['latest_post'], 25) }}</div>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center text-muted py-5">
            <i class="bi bi-people fs-1 mb-2 d-block"></i>
            <div class="fs-6">No active authors found.</div>
          </div>
        @endif
      </div>
    </div>

  </div>
</div>
@endsection
