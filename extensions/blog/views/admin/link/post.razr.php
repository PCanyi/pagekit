<div class="uk-form-row">
    <label class="uk-form-label" for="form-post">@trans('Post')</label>
    <div class="uk-form-controls">
        <select id="form-post" class="uk-width-1-1" name="id">
            @foreach (posts as post)
            <option value="@post.id">@post.title</option>
            @endforeach
        </select>
    </div>
</div>

<script>

    require(['jquery', 'link'], function($, Link) {

        Link.register('@route', function(link, form) {

            var $id = $('[name="id"]', form);

                $id.on('change', function() {
                    link.set($id.serialize());
                });

            return {

                show: function(params, url) {
                    $id.val($('option[value="'+params['id']+'"]', $id).length ? params['id'] : $('option:first', $id).val());
                },

                update: function() {
                    $id.trigger('change');
                }

            }

        });

    });

</script>