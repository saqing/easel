<h2 class="help-topic-header" id="posts">Posts</h2>
<p>
    Create a new post by clicking the <span class="zmdi zmdi-collection-bookmark"></span> Posts
    menu item in the sidebar, and then clicking <a href="{!! route('canvas.admin.post.create') !!}">Add New</a>. If you get interrupted and want to save your work for later, just toggle the
    <code>Draft?</code> button and click
    <span class="label label-primary"><span class="zmdi zmdi-floppy"></span> PUBLISH</span> to make
    sure that the post is not visible on your blog yet.
</p>
<p>
    The fastest and easiest way to write in Canvas is to utilize Markdown. The split-screen editor allows you full-screen flexibility and live formatting to make your writing experience smooth and effortless. For a beginners' primer or to just brush up on your skills, take a look at the <a href="{!! route('canvas.blog.post.show', 'hello-world') !!}" target="_blank">Hello World</a> post.
</p>
<p>
    From the <a href="{!! route('canvas.admin.post.index') !!}">Posts</a> overview page, you can click the <span class="zmdi zmdi-edit text-primary"></span> icon next to each
    post to update its contents or the <span class="zmdi zmdi-search text-primary"></span> icon to see what it looks like to
    your readers.
</p>
<p>
    To delete a post, go to the <a href="{!! route('canvas.admin.post.index') !!}">Posts</a> page and click the <span class="zmdi zmdi-edit text-primary"></span> action on a specific post.
    On the next page, click <span class="label label-danger"><span class="zmdi zmdi-delete"></span> DELETE</span> to completely delete the post from the blog.
</p>

<br>