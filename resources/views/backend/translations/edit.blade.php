<h3>Editing: {{ $group }}</h3>

<form method="POST" action="{{ url('admin/translations/update-all') }}">
@csrf
<input type="hidden" name="group" value="{{ $group }}">

<table border="1" cellpadding="6">
<tr>
    <th>Key</th>
    <th>EN</th>
    <th>DE</th>
    <th>FR</th>
    <th>Action</th>
</tr>

@foreach($rows as $key => $langs)
<tr>

<td>{{ $key }}</td>

@foreach(['en','de','fr'] as $lang)
<td>
    <input
        name="data[{{ $key }}][{{ $lang }}]"
        value="{{ $langs[$lang] }}"
    >
</td>
@endforeach

<td>
    <form method="POST" action="{{ url('admin/translations/update-one') }}">
        @csrf
        <input type="hidden" name="group" value="{{ $group }}">
        <input type="hidden" name="key" value="{{ $key }}">
        @foreach(['en','de','fr'] as $lang)
            <input type="hidden"
                   name="values[{{ $lang }}]"
                   value="{{ $langs[$lang] }}">
        @endforeach
        <button>Update</button>
    </form>
</td>

</tr>
@endforeach
</table>

<br>
<button>Update All</button>
</form>