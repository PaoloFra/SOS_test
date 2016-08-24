{{ content() }}

{{  form('', 'id': 'search-form', 'class': 'form-inline') }}
<div class="row">
    <div class="col-md-1 col-md-offset-2">From:</div>
    <div class="col-md-9">
        <div class="form-group">
            {{  text_field('StartAddress', 'class' : 'form-control', 'placeholder' : 'Start address', 'size':80)}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-2">To:</div>
    <div class="col-md-9">
        <div class="form-group">
            {{  text_field('EndAddress', 'class' : 'form-control', 'placeholder' : 'End address', 'size':80)}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-md-offset-6">
        <ul class="pager nomargin">
            <li class="previous">
                <a href="#" id="newRoute">Estimate</a>
            </li>
        </ul>
    </div>
</div>
<div class="row" id="svli"><div class="col-md-3 col-md-offset-4" id="errmsg"></div></div>
{{ end_form() }}

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8" id="estimate">
    </div>
</div>



{{ javascript_include('js/afterUber.js') }}

