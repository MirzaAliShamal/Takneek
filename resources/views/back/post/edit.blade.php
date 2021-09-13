<!--begin::Form-->
<form class="space_form" id=""  action="{{ route('post.save', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="col-lg-12">
            <label>Post Type:</label>
            <select name="post_type" id="post_type" class="form-control">
                <option value="blog" {{ $post->post_type == "blog" ? 'selected' : '' }}>Blog</option>
                <option value="poll" {{ $post->post_type == "poll" ? 'selected' : '' }}>Poll</option>
                <option value="job" {{ $post->post_type == "job" ? 'selected' : '' }}>Job</option>
                <option value="updates" {{ $post->post_type == "updates" ? 'selected' : '' }}>Updates</option>
            </select>

            <span class="form-text text-muted">Post Type:</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Images:</label>
            <div class="input-images"></div>

            <span class="form-text text-muted">Images:</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $post->title }}" autocomplete="off">
            <span class="form-text text-muted">Title:</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Content:</label>
            <textarea name="content" id="content">{{ $post->content }}</textarea>
            <span class="form-text text-muted">Content:</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Tags:</label>
            <input class="form-control tagify" id="basic_tagify_1" name='tags[]' placeholder='type...' value="{{ implode(', ', $post->post_tags()->pluck('name')->toArray()) }}" autofocus="">
            <span class="form-text text-muted">Tags:</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-6">
            <label>Category:</label>
            <select name="post_category_id" id="post_category_id" class="form-control">
                <option value="" selected>Nothing Selected</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{ $post->post_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>

            <span class="form-text text-muted">Category:</span>
        </div>
        <div class="col-lg-6">
            <label>Author:</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="" selected>Nothing Selected</option>
                @foreach ($users as $item)
                    <option value="{{ $item->id }}" {{ $post->user_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>

            <span class="form-text text-muted">Category:</span>
        </div>
    </div>

    <div class="form-group row poll-post-fields" style="{{ $post->post_type == "poll" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <h3 class="mb-0">Poll Post:</h3>
        </div>
    </div>
    <div class="form-group row poll-post-fields" style="{{ $post->post_type == "poll" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <label>Poll Type</label>
            <select name="poll_type" id="poll_type" class="form-control">
                <option value="single" {{ $post->poll_type == "single" ? 'selected' : '' }}>Single Choice</option>
                <option value="multiple" {{ $post->poll_type == "multiple" ? 'selected' : '' }}>Multiple Choice</option>
            </select>
        </div>
    </div>
    <div class="form-group row poll-post-fields" style="{{ $post->post_type == "poll" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <label>Poll Question</label>
            <input type="text" class="form-control" id="poll_question" name="poll_question" autocomplete="off" value="{{ $post->poll_question }}" placeholder="Poll Question">
        </div>
    </div>
    <div class="form-group row poll-post-fields" style="{{ $post->post_type == "poll" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <label>How many option?</label>
            <select name="poll_option_count" id="poll_option_count" class="form-control">
                <option value="" selected>Nothing Selected</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ $post->poll_option_count == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="col-lg-12">
            <div class="poll-option-append mt-3"></div>
        </div>
    </div>

    <div class="form-group row job-post-fields" style="{{ $post->post_type == "job" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <h3 class="mb-0">Job Post:</h3>
        </div>
    </div>
    <div class="form-group row job-post-fields" style="{{ $post->post_type == "job" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <label>Requirements:</label>
            <input class="form-control tagify" id="basic_tagify_2" name='job_requirements' placeholder='type...' value="{{ $post->job_requirements }}" autofocus="">
            <span class="form-text text-muted">Tags:</span>
        </div>
    </div>
    <div class="form-group row job-post-fields" style="{{ $post->post_type == "job" ? '' : 'display: none;' }}">
        <div class="col-lg-6">
            <label>Type</label>
            <select name="job_type" id="job_type" class="form-control">
                <option value="fulltime"  {{ $post->job_type == "fulltime" ? 'selected' : '' }}>Full Time</option>
                <option value="freelancer" {{ $post->job_type == "freelancer" ? 'selected' : '' }}>Freelancer</option>
                <option value="intern" {{ $post->job_type == "intern" ? 'selected' : '' }}>Intern</option>
                <option value="parttime" {{ $post->job_type == "parttime" ? 'selected' : '' }}>Part Time</option>
            </select>
        </div>
        <div class="col-lg-6">
            <label>Salary</label>
            <input type="text" class="form-control" name="job_salary" id="job_salary" value="{{ $post->job_salary }}" autocomplete="off" placeholder="Salary">
        </div>
    </div>
    <div class="form-group row job-post-fields" style="{{ $post->post_type == "job" ? '' : 'display: none;' }}">
        <div class="col-lg-12">
            <label>Technologies:</label>
            <input class="form-control tagify" id="basic_tagify_3" name='job_technologies' placeholder='type...' value="{{ $post->job_technologies }}" autofocus="">
            <span class="form-text text-muted">Tags:</span>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary mr-2 save btn-block">Update Post</button>
            </div>
        </div>
    </div>
</form>
<!--end::Form-->
