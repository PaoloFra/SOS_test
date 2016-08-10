{{ content() }}

<div class="row">
    <div class="col-md-3">
        <ul class="pager nomargin">
            <li class="previous">
                <a href="#" id="newMsg">Новое сообщение</a>
            </li>
        </ul>
    </div>
    <div class="col-md-1">
        <a href="?reset=1" class="nohoverdec">
            <button class="btn btn-link" type="button">
                <span class="glyphicon glyphicon-eye-close"></span>
            </button>
        </a>
    </div>
    <div class="col-md-7">
        {{  form('', 'id': 'search-form', 'class': 'form-inline') }}
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {{  text_field('name', 'class' : 'form-control', 'placeholder' : 'Имя')}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{  text_field('phone', 'class' : 'form-control', 'placeholder' : 'телефон')}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{  text_field('message', 'class' : 'form-control', 'placeholder' : 'сообщение')}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="input-group">
                        {{  text_field('mail', 'class' : 'form-control', 'placeholder' : 'e-mail')}}
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
</div>
<div class="row" id="svli"><div class="col-md-3 col-md-offset-4" id="errmsg"></div></div>



<table class="table table-bordered table-striped" align="center" id="msglist">
    <thead>
    <tr><th></th>
        {% for head in headings %}
            <th>
                {% if head['sort'] == false %}
                    <a href="?sort={{head['field']}}&order=desc">{{ head['name'] }}</a>
                {% else %}
                    <a href="?sort={{head['field']}}&order={{head['sort']}}">{{ head['name'] ~ head['arrow']}}</a>
                {% endif %}
            </th>
        {% endfor %}
        <th>Действия</th>

    </tr>
    </thead>
    <tbody>
    {% if page.items %}
        {% for msg in page.items %}
            <tr >
                <td>{{ msg.id }}.</td>
                <td><input type="text" placeholder="Имя" class="form-control" id="name{{ msg.id }}" value="{{ msg.name }}" disabled="disabled"></td>
                <td><input type="text" placeholder="телефон" class="form-control" id="phone{{ msg.id }}" value="{{ msg.phone }}" disabled="disabled"></td>
                <td><input type="text" placeholder="email" class="form-control" id="mail{{ msg.id }}" value="{{ msg.mail }}" disabled="disabled"></td>
                <td><input type="text" placeholder="сообщение" class="form-control" id="message{{ msg.id }}" value="{{ msg.message }}" disabled="disabled"></td>
                <td>{{ date('d.m.Y H:i:s', strtotime(msg.date)) }}</td>
                <td width="100">
                    <a type="button" class="btn btn-default btn-sm editMsg" data-id="{{ msg.id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                <a type="button" class="btn btn-danger btn-sm delMsg" data-id="{{ msg.id }}"><span class="glyphicon glyphicon-trash"></span></a>
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

{{ javascript_include('js/sos.js') }}
<script type="text/javascript">
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: "yyyy-mm-dd"
        });
    });
</script>

