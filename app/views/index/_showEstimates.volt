<table class="table table-striped table-bordered table-condensed table-hover table-responsive">
    {% for item in products %}
        <tr>
            <td>{{ item.display_name }}</td>
            <td>{{ item.estimate }}</td>
            <td class="info" align="right">{{ item.display_name2 }}</td>
            <td class="success">{{ item.estimate2 }}</td>
        </tr>
    {% endfor %}
</table>
