<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title"
           value="{{ isset($post->title) ? $post->title : ''}}">
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea"
              id="content">{{ isset($post->content) ? $post->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title_image') ? 'has-error' : ''}}">
    <label for="title_image" class="control-label">{{ 'Title Image' }}</label>
    <input class="form-control" name="title_image" type="file" id="title_image"
           value="{{ isset($post->title_image) ? $post->title_image : ''}}" accept="image/jpeg, image/png">
    {!! $errors->first('title_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content_image') ? 'has-error' : ''}}">
    <label for="content_image" class="control-label">{{ 'Content Image' }}</label>
    <input class="form-control" accept="image/jpeg, image/png" name="content_image" type="file" id="content_image"
           value="{{ isset($post->content_image) ? $post->content_image : ''}}">
    {!! $errors->first('content_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea"
              id="description">{{ isset($post->description) ? $post->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
