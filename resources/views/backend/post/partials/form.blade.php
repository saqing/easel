@if(Route::is('canvas.admin.post.create'))
    <form class="keyboard-save" role="form" method="POST" id="postCreate" action="{!! route('canvas.admin.post.store') !!}">
    <input type="hidden" name="user_id" value="{!! Auth::guard('canvas')->user()->id !!}">
@else
    <form class="keyboard-save" role="form" method="POST" id="postUpdate" action="{!! route('canvas.admin.post.update', $id) !!}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="user_id" value="{!! $user_id !!}">
@endif
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    @if(Route::is('canvas.admin.post.create'))
                        <ol class="breadcrumb">
                            <li><a href="{!! route('canvas.admin') !!}">Home</a></li>
                            <li><a href="{!! route('canvas.admin.post.index') !!}">Posts</a></li>
                            <li class="active">New Post</li>
                        </ol>
                        <h2>Create a New Post</h2>
                    @else
                        <ol class="breadcrumb">
                            <li><a href="{!! route('canvas.admin') !!}">Home</a></li>
                            <li><a href="{!! route('canvas.admin.post.index') !!}">Posts</a></li>
                            <li class="active">Edit Post</li>
                        </ol>
                        <h2>
                            Edit <em>{!! $title !!}</em>
                            <small>Last edited on {!! $updated_at->format('M d, Y') !!} at {!! $updated_at->format('g:i A') !!}</small>
                        </h2>
                    @endif
                </div>

                <div class="card-body card-padding">

                    @include('canvas::backend.shared.partials.errors')

                    <div class="form-group">
                        <div class="fg-line">
                            <input type="text" class="form-control" name="title" id="title" value="{{ $title }}" placeholder="Title">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $slug }}" placeholder="Slug">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}" placeholder="Subtitle">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="fg-line">
                            <textarea id="editor" name="content" placeholder="Content" v-pre>{{ $content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Publishing</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">
                    <label><i class="zmdi zmdi-eye"></i>&nbsp;&nbsp;Status</label>
                    <div class="form-group" style="padding-top: 10px">
                        <div class="toggle-switch toggle-switch-demo" data-ts-color="blue">
                            <label for="is_published" class="ts-label"><span class="label label-default">Draft</span></label>
                            <input {{ \Canvas\Helpers\CanvasHelper::checked($is_published) }} type="checkbox" name="is_published">
                            <label for="is_published" class="ts-helper"></label>
                            <label for="is_published" class="ts-label" style="margin-left: 20px; margin-right: 0"><span class="label label-primary">Published</span></label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="fg-line">
                            <label><i class="zmdi zmdi-calendar"></i>&nbsp;&nbsp;Published at</label>
                            <input class="form-control datetime-picker" name="published_at" id="published_at" type="text" value="{{ $published_at }}" placeholder="YYYY/MM/DD HH:MM:SS" data-mask="0000/00/00 00:00:00">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="fg-line">
                            <label class="fg-label"><i class="zmdi zmdi-view-web"></i>&nbsp;&nbsp;Layout</label>
                            <input type="text" class="form-control" name="layout" id="layout" value="{{ $layout }}" placeholder="Layout" disabled>
                        </div>
                    </div>
                    <br>
                    @if(!Route::is('canvas.admin.post.create'))
                        <div class="form-group">
                            <div class="fg-line">
                                <label class="fg-label"><i class="zmdi zmdi-link"></i>&nbsp;&nbsp;Permalink</label><br>
                                <a href="{!! route('canvas.blog.post.show', $slug) !!}" target="_blank" name="permalink">{!! route('canvas.blog.post.show', $slug) !!}</a>
                            </div>
                        </div>
                        <br>
                    @endif
                    <div class="form-group">
                        @if(Route::is('canvas.admin.post.create'))
                            <button type="submit" class="btn btn-primary btn-icon-text">
                                <i class="zmdi zmdi-floppy"></i> Publish
                            </button>
                            &nbsp;
                            <a href="{!! route('canvas.admin.post.index') !!}">
                                <button type="button" class="btn btn-link">Cancel</button>
                            </a>
                        @else
                            <button type="submit" class="btn btn-primary btn-icon-text" name="action" value="continue">
                                <i class="zmdi zmdi-floppy"></i> Update
                            </button>
                            &nbsp;
                            <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete" id="confirmDelete">
                                <i class="zmdi zmdi-delete"></i> Delete
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Featured Image</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">
                    <div class="form-group">
                        <div class="fg-line">
                            <div class="input-group">
                                <input type="text" class="form-control" name="page_image" id="page_image" alt="Image thumbnail" placeholder="Page Image" v-model="pageImage">
                                <span class="input-group-btn" style="margin-bottom: 11px">
                        <button style="margin-bottom: -5px" type="button" class="btn btn-primary waves-effect" @click="openFromPageImage()">Select Image</button>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="visible-sm space-10"></div>
                    <div>
                        <img v-if="pageImage" class="img img-responsive" id="page-image-preview" style="margin-top: 3px; max-height:100px;" :src="pageImage">
                        <span v-else class="text-muted small">No Image Selected</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Tags</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">
                    <div class="form-group">
                        <div class="fg-line">
                            <select name="tags[]" id="tags" class="selectpicker" multiple>
                                @foreach ($allTags as $tag)
                                    <option @if (in_array($tag, $tags)) selected @endif value="{!! $tag !!}">{!! $tag !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>SEO Description</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">
                    <div class="form-group">
                        <div class="fg-line">
                            <textarea class="form-control auto-size" name="meta_description" id="meta_description" style="resize: vertical" placeholder="Meta Description">{!! $meta_description !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<media-modal v-if="showMediaManager" @media-manager-close="showMediaManager = false">
<media-manager
        :is-modal="true"
        :selected-event-name="selectedEventName"
        prefix="/admin/"
        @media-manager-close="showMediaManager = false"
                                           >
</media-manager>
