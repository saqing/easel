<form class="keyboard-save" role="form" method="POST" id="settings" action="{!! route('canvas.admin.settings') !!}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label">Blog Title</label>
            <input type="text" class="form-control" name="blog_title" id="blog_title" value="{{ $data['blogTitle'] }}" placeholder="Blog Title">
        </div>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label">Blog Subtitle</label>
            <input type="text" class="form-control" name="blog_subtitle" id="blog_subtitle" value="{{ $data['blogSubtitle'] }}" placeholder="Blog Subtitle">
        </div>
        <small>In a few words, explain what this site is about.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label">Blog Description</label>
            <input type="text" class="form-control" name="blog_description" id="blog_description" value="{{ $data['blogDescription'] }}" placeholder="Blog Description">
        </div>
        <small>Set the blog description that you would like to add to the <code>description</code> meta tag.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label">Blog SEO</label>
            <input type="text" class="form-control" name="blog_seo" id="blog_seo" value="{{ $data['blogSeo'] }}" placeholder="Blog SEO">
        </div>
        <small>Define in comma-delimited form the blog SEO tags that you want in the <code>keywords</code> meta tag.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label">Blog Author</label>
            <input type="text" class="form-control" name="blog_author" id="blog_author" value="{{ $data['blogAuthor'] }}" placeholder="Blog Author">
        </div>
        <small>Set the name that you want to appear in the <code>author</code> meta tag.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="ts-label" for="post_is_published_default">Publish Posts by Default?</label>
            <div>
                <div class="toggle-switch toggle-switch-demo" data-ts-color="blue">
                    <input {{ \Canvas\Helpers\CanvasHelper::checked($data['postIsPublishedDefault']) }} type="checkbox" name="post_is_published_default">
                    <label for="post_is_published_default" class="ts-helper"></label>
                </div>
            </div>
            <small>When this option is checked, new posts will be created with the <code>published</code> status by default, rather than <code>draft</code>.</small>
        </div>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label">Social Header Icons</label>
            <select name="social_header_icons_user_id" id="social_header_icons_user_id" class="selectpicker">
                @foreach (\Canvas\Models\User::all() as $user)
                    <option @if ($user->id == $data['socialHeaderIconsUserId']) selected @endif value="{!! $user->id !!}">{!! $user->display_name !!}</option>
                @endforeach
            </select>
        </div>
        <small>Select the user whose social icons you would like to appear in the header of the blog.</small>
    </div>

    <br>

    @if ('asia/shanghai' != strtolower(env('APP_TIMEZONE')))
        <div class="form-group">
            <div class="fg-line">
                <label class="fg-label"><i class="zmdi zmdi-disqus"></i> Disqus</label>
                <input type="text" class="form-control" name="disqus_name" id="disqus_name" value="{{ $data['disqus'] }}" placeholder="Disqus Shortname">
            </div>
            <small>Enter your Disqus shortname to enable comments in your blog posts or <a href="https://cnvs.readme.io/docs/options#section-disqus" target="_blank">learn more about this option</a>.</small>
        </div>
        <br>
    @else
        <div class="form-group">
            <div class="fg-line">
                <label class="fg-label"><i class="zmdi zmdi-comment"></i> ChangYan AppID</label>
                <input type="text" class="form-control" name="changyan_appid" id="changyan_appid" value="{{ $data['changyan_appid'] }}" placeholder="Changyan AppID">
            </div>
            <small>Enter your Changyan AppID or <a href="http://changyan.kuaizhan.com/" target="_blank">learn more about this option</a>.</small>
        </div>
        <br>
        <div class="form-group">
            <div class="fg-line">
                <label class="fg-label"><i class="zmdi zmdi-comment"></i> ChangYan Conf</label>
                <input type="text" class="form-control" name="changyan_conf" id="changyan_conf" value="{{ $data['changyan_conf'] }}" placeholder="Changyan Conf">
            </div>
            <small>Enter your Changyan Conf or <a href="http://changyan.kuaizhan.com/" target="_blank">learn more about this option</a>.</small>
        </div>
        <br>
    @endif

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label"><i class="zmdi zmdi-trending-up"></i> Google Analytics</label>
            <input type="text" class="form-control" name="ga_id" id="ga_id" value="{{ $data['analytics'] }}" placeholder="Google Analytics Tracking ID">
        </div>
        <small>Enter your Google Analytics Tracking ID or <a href="https://cnvs.readme.io/docs/options#section-google-analytics" target="_blank">learn more about this option</a>.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label"><i class="zmdi zmdi-twitter-box"></i> Twitter Card Type</label>
            <select name="twitter_card_type" id="twitter_card_type" class="selectpicker">
                <option @if ($data['twitterCardType'] == "none") selected @endif value="none">No card</option>
                <option @if ($data['twitterCardType'] == "summary") selected @endif value="summary">Summary card</option>
                <option @if ($data['twitterCardType'] == "summary_large_image") selected @endif value="summary_large_image">Summary card with large image</option>
            </select>
        </div>
        <small>Configure the way Twitter <a href="https://cards-dev.twitter.com/validator" target="_blank">displays links to your blog</a> or <a href="https://dev.twitter.com/cards/overview" target="_blank">learn more about this option</a>.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label"><i class="zmdi zmdi-invert-colors"></i> Theme</label>
            <select name="theme" id="theme" class="selectpicker">
                <option @if ($data['active_theme'] == "default") selected @endif value="default">{!! $data['default_theme_name'] !!}</option>
                @foreach($data['themes'] as $themeId => $themeName)
                    <option @if ($data['active_theme'] == $themeId) selected @endif value="{!! $themeId !!}">{{ $themeName }}</option>
                @endforeach
            </select>
        </div>
        <small>Change the appearance of your blog with Canvas themes.</small>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label"><i class="zmdi zmdi-language-css3"></i> Custom CSS</label>
            <textarea class="form-control" rows="10" name="custom_css" id="custom_css" style="resize: vertical" placeholder="Define your own CSS styles for the blog here.">{{ $data['custom_css'] }}</textarea>
        </div>
    </div>

    <br>

    <div class="form-group">
        <div class="fg-line">
            <label class="fg-label"><i class="zmdi zmdi-language-javascript"></i> Custom JS</label>
            <textarea class="form-control" rows="10" name="custom_js" id="custom_js" style="resize: vertical" placeholder="Define your own JS scripts for the blog here.">{{ $data['custom_js'] }}</textarea>
        </div>
    </div>

    <br>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save Changes</button>
    </div>
</form>
