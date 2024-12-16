<table>
    
    <thead>
    <tr>
        <th>Hull Number</th>
        <th>Type</th>
        <th>Model</th>
        <th>Merk</th>
        <th>SN</th>
        <th>Engine SN</th>
        <th>Year Build</th>
        <th>Buying Date</th>
        <th>Operator</th>
        <th>Location</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listRows as $row)
        <tr>
            <td>{{ $row->hull_number }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->model }}</td>
            <td>{{ $row->merk }}</td>
            <td>{{ $row->sn }}</td>
            <td>{{ $row->engine_sn }}</td>
            <td>{{ $row->year_build }}</td>
            <td>{{ $row->buying_date }}</td>
            <td>{{ $row->operator_name }}</td>
            <td>{{ $row->location_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>