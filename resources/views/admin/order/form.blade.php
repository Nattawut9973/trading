<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($order->title) ? $order->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User ID' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($order->user_id) ? $order->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product ID' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($order->product_id) ? $order->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Status' }}</label>
    <select class="form-control" name="status" value="{{ isset($order->status) ? $order->status : ''}}">
        <option>Buy</option>
        <option>Sell</option>
    </select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total_price') ? 'has-error' : ''}}">
    <label for="total_price" class="control-label">{{ 'Total Price' }}</label>
    <input class="form-control" name="total_price" type="number" id="total_price" value="{{ isset($order->total_price) ? $order->total_price : ''}}" >
    {!! $errors->first('total_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($order->description) ? $order->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
