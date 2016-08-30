<div class="row">
    <div class="col-md-1">
        <a href="?reset=1" class="nohoverdec">
            <button class="btn btn-link" type="button">
                <span class="glyphicon glyphicon-eye-close"></span>
            </button>
        </a>
    </div>
    <div class="col-md-4">
        {{  form('', 'id': 'search-form', 'class': 'form-inline') }}
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <div class="input-group">
                        {{  text_field('term', 'class': 'form-control', 'placeholder': 'title 1')}}
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{ end_form() }}
    </div>
    <div class="col-md-2"><a href="/" class="btn btn-info">ORM</a> </div>
    <div class="col-md-2"><a href="/index/sql" class="btn btn-info">SQL</a> </div>
    <div class="col-md-2"><a href="/index/ormc" class="btn btn-info">ORM cached</a> </div>
</div>
<div class="row" id="svli">
    <div class="col-md-3"><h2>{{ mode }}</h2></div>
    <div class="col-md-4" id="errmsg"><hr>time elapsed: {{ timer }} sec.<hr></div>
</div>

<table class="table table-bordered table-striped" align="center" id="msglist">
    <thead>
    <tr>
        {% for head in headings %}
            <th>
                {% if head['sort'] == false %}
                    <a href="?sort={{head['field']}}&order=desc">{{ head['name'] }}</a>
                {% else %}
                    <a href="?sort={{head['field']}}&order={{head['sort']}}">{{ head['name'] ~ head['arrow']}}</a>
                {% endif %}
            </th>
        {% endfor %}

    </tr>
    </thead>
    <tbody>
    {% if page.items %}
        {% for msg in page.items %}
            <tr >
                <td><input type="text" placeholder="Имя" class="form-control" id="name{{ msg.id }}" value="{{ msg.id }}. {{ msg.cx }}" disabled="disabled"></td>
                <td><input type="text" placeholder="телефон" class="form-control" id="phone{{ msg.id }}" value="{{ msg.rx }}" disabled="disabled"></td>
                <td><input type="text" placeholder="email" class="form-control" id="mail{{ msg.id }}" value="{{ msg.title }}" disabled="disabled"></td>
                <td>{% if msg.TbRel %}
                        {% for rel in msg.TbRel %}
                        <div>{{ rel.ndc }}</div>
                        {% endfor %}
                    {% endif %}
                </td>
            </tr>
        {% endfor %}
    {% endif %}
    </tbody>

</table>

<ul class="pagination">
    <li class=""><a href="?page=1">Первая</a></li>
    <li class=""><a href="?page={{page.before}}">&#8592;</a></li>
    <li class=""><a href="?page={{page.next}}">&#8594;</a></li>
    <li class=""><a href="?page={{page.last}}">Последняя</a></li>
    <li class="disabled"><a href="#">{{ page.current}} / {{page.total_pages}}</a></li>
</ul>

{#{{ javascript_include('js/sos.js') }}#}


