<h2 class="help-topic-header" id="tags">Tags</h2>
<p>
    Tags provide grouping and organization to your blog posts. You can create a new tag by visiting the <span class="zmdi zmdi-labels"></span> Tags
    menu item in the sidebar, and then clicking <a href="{!! route('canvas.admin.tag.create') !!}">Add New</a>.
    Once you specify a name, title and subtitle, click <span class="label label-primary"><span class="zmdi zmdi-floppy"></span> SAVE</span> to
    store your new tag in the database.
</p>
<p>
    Assigning a tag to a specific blog post is easy. Just go to the <a href="{!! route('canvas.admin.post.index') !!}">Posts</a> page and click the <span class="zmdi zmdi-edit text-primary"></span> action
    of whichever post you want to assign the tag to. From this screen, click <code>Tags</code> and select the name of the tag you just created. Once you click
    <span class="label label-primary"><span class="zmdi zmdi-floppy"></span> UPDATE</span> at the bottom of the page, the blog post will be
    grouped under that specific tag.
</p>
<p>
    To delete a tag, go to the <a href="{!! route('canvas.admin.tag.index') !!}">Tags</a> page and click the <span class="zmdi zmdi-edit text-primary"></span> action on a specific tag.
    On the following page, click <span class="label label-danger"><span class="zmdi zmdi-delete"></span> DELETE</span> to completely remove the tag from the blog.
</p>

<br>