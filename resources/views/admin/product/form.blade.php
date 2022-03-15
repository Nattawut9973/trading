<div class="form-group {{ $errors->has('symbol') ? 'has-error' : ''}}">
    <label for="symbol" class="control-label">{{ 'Symbol' }}</label>
    <input class="form-control" name="symbol" type="text" id="symbol" value="{{ isset($product->symbol) ? $product->symbol : ''}}" >
    {!! $errors->first('symbol', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('open') ? 'has-error' : ''}}">
    <label for="open" class="control-label">{{ 'Open' }}</label>
    <input class="form-control" name="open" type="number" id="open" value="{{ isset($product->open) ? $product->open : ''}}" >
    {!! $errors->first('open', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('high') ? 'has-error' : ''}}">
    <label for="high" class="control-label">{{ 'High' }}</label>
    <input class="form-control" name="high" type="number" id="high" value="{{ isset($product->high) ? $product->high : ''}}" >
    {!! $errors->first('high', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('low') ? 'has-error' : ''}}">
    <label for="low" class="control-label">{{ 'Low' }}</label>
    <input class="form-control" name="low" type="number" id="low" value="{{ isset($product->low) ? $product->low : ''}}" >
    {!! $errors->first('low', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('last') ? 'has-error' : ''}}">
    <label for="last" class="control-label">{{ 'Last' }}</label>
    <input class="form-control" name="last" type="number" id="last" value="{{ isset($product->last) ? $product->last : ''}}" >
    {!! $errors->first('last', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('change') ? 'has-error' : ''}}">
    <label for="change" class="control-label">{{ 'Change' }}</label>
    <input class="form-control" name="change" type="number" id="change" value="{{ isset($product->change) ? $product->change : ''}}" >
    {!! $errors->first('change', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('percent_change') ? 'has-error' : ''}}">
    <label for="percent_change" class="control-label">{{ 'Percent Change' }}</label>
    <input class="form-control" name="percent_change" type="number" id="percent_change" value="{{ isset($product->percent_change) ? $product->percent_change : ''}}" >
    {!! $errors->first('percent_change', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bid') ? 'has-error' : ''}}">
    <label for="bid" class="control-label">{{ 'Bid' }}</label>
    <input class="form-control" name="bid" type="number" id="bid" value="{{ isset($product->bid) ? $product->bid : ''}}" >
    {!! $errors->first('bid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('offer') ? 'has-error' : ''}}">
    <label for="offer" class="control-label">{{ 'Offer' }}</label>
    <input class="form-control" name="offer" type="number" id="offer" value="{{ isset($product->offer) ? $product->offer : ''}}" >
    {!! $errors->first('offer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('volumn') ? 'has-error' : ''}}">
    <label for="volumn" class="control-label">{{ 'Volumn' }}</label>
    <input class="form-control" name="volumn" type="number" id="volumn" value="{{ isset($product->volumn) ? $product->volumn : ''}}" >
    {!! $errors->first('volumn', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="control-label">{{ 'Value' }}</label>
    <input class="form-control" name="value" type="number" id="value" value="{{ isset($product->value) ? $product->value : ''}}" >
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
