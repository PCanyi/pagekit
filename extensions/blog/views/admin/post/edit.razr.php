@script('posts-edit', 'blog/js/post/edit.js', 'requirejs')

<form id="js-post" class="uk-form uk-form-stacked" action="@url.route('@blog/post/save')" method="post">

    <div class="pk-toolbar">
        <button class="uk-button uk-button-primary" type="submit">@trans('Save') <i class="uk-icon-spinner uk-icon-spin js-spinner uk-margin-small-left uk-hidden"></i></button>
        <a class="uk-button js-cancel" href="@url.route('@blog/post/index')" data-label="@trans('Close')">@(post.id ? trans('Close') : trans('Cancel'))</a>
    </div>

    <div class="uk-grid uk-grid-divider" data-uk-grid-margin data-uk-grid-match>
        <div class="uk-width-medium-3-4">

            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" type="text" name="post[title]" value="@post.title" placeholder="@trans('Enter Title')" required>
                <input type="hidden" name="id" value="@(post.id ?: 0)">
            </div>
            <div class="uk-form-row">
                @editor('post[content]', post.content, ['id' => 'post-content', 'data-markdown' => post.get('markdown', '0')])
            </div>

            <div class="uk-form-row">
                <textarea class="uk-width-1-1 uk-form-large" type="text" name="post[excerpt]" placeholder="@trans('Enter Excerpt')">@post.excerpt</textarea>
            </div>

        </div>
        <div class="uk-width-medium-1-4 pk-sidebar-right">

            <div class="uk-panel uk-panel-divider">
                <div class="uk-form-row">
                    <label class="uk-form-label">@trans('Status')</label>
                    <div class="uk-form-controls">
                        <select class="uk-width-1-1" name="post[status]">
                            @foreach(statuses as id => status)
                            <option value="@id"@(post.status == id ? ' selected')>@status</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">@trans('Publish on')</label>
                    <div class="uk-form-controls">
                        <a class="js-publish" href="#" data-uk-toggle="{target:'.js-publish'}">@post.date|date @ @post.date|date('H:i')</a>
                        <input class="uk-form-width-small uk-form-small uk-hidden js-publish" type="text" data-uk-datepicker="{ format: 'YYYY-MM-DD' }" name="" value="@post.date|date('Y-m-d')">
                        <input class="uk-form-width-small uk-form-small uk-hidden js-publish" type="text" data-uk-timepicker="{ showSeconds: true }" name="" value="@post.date|date('H:i:s')">
                        <input type="hidden" name="post[date]" value="@post.date|date('Y-m-d H:i:s')">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">@trans('Slug')</label>
                    <div class="uk-form-controls">
                        <input class="uk-width-1-1" type="text" name="post[slug]" value="@post.slug">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label">@trans('Restrict Access')</label>
                    <input type="hidden" name="post[roles]" value="">
                    @foreach (roles as role)
                    <div class="uk-form-controls">
                        <label><input type="checkbox" name="post[roles][]" value="@role.id"@(post.hasRole(role) ? ' checked')> @role.name</label>
                    </div>
                    @endforeach
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label">@trans('Options')</label>
                    <div class="uk-form-controls">
                        <label><input type="checkbox" name="post[data][title]" value="1"@(post.get('title', 1) ? ' checked')> @trans('Show Title')</label>
                    </div>
                    <div class="uk-form-controls">
                        <label><input type="checkbox" name="post[data][markdown]" value="1"@(post.get('markdown', 0) ? ' checked')> @trans('Enable Markdown')</label>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @token()

</form>