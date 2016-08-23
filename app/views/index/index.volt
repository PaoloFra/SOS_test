{{ content() }}

{{  form('', 'id': 'search-form', 'class': 'form-inline') }}
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <div class="form-group">
            {{  text_field('StartAddress', 'class' : 'form-control', 'placeholder' : 'Start address', 'size':80)}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <div class="form-group">
            {{  text_field('EndAddress', 'class' : 'form-control', 'placeholder' : 'End address', 'size':80)}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <ul class="pager nomargin">
            <li class="previous">
                <a href="#" id="newRoute">Estimate</a>
            </li>
        </ul>
    </div>
</div>
<div class="row" id="svli"><div class="col-md-3 col-md-offset-4" id="errmsg"></div></div>
{{ end_form() }}




{{ javascript_include('js/afterUber.js') }}

