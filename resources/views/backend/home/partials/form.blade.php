<input type="hidden" name="user_id" value="{{ Auth::guard('canvas')->user()->id }}">

<div class="form-group">
    <div class="fg-line">
        <input type="text" class="form-control" name="title" id="title"  placeholder="Title" value="{{ old('title') }}">
    </div>
</div>

<div class="form-group hidden">
    <div class="fg-line">
        <input type="text" class="form-control" name="slug" id="slug" placeholder="Post Slug" value="{{ old('slug') }}">
    </div>
</div>

<div class="form-group">
    <div class="fg-line">
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Subtitle" value="{{ old('subtitle') }}">
    </div>
</div>

<div class="form-group">
    <div class="fg-line">
        <textarea class="form-control auto-size" id="editor" name="content" placeholder="What's on your mind?">{{ old('content') }}</textarea>
    </div>
</div>

<div class="form-group hidden">
    <div class="fg-line">
        <input class="form-control datetime-picker" name="published_at" id="published_at" type="text" value="{{ date('Y-m-d G:i:s') }}">
    </div>
</div>

<div class="checkbox m-b-15 hidden">
    <label>
        <input type="checkbox" name="is_published">
        <i class="input-helper"></i>
        Published?
    </label>
</div>

<div class="form-group hidden">
    <div class="fg-line">
        <input type="text" class="form-control" name="layout" id="layout" value="{{ config('blog.post_layout') }}" placeholder="Layout">
    </div>
</div>
