<table>
    
    <thead>
    <tr>
        <th colspan="5" align="center">
            <b>{{ $locationName }}</b>
        </th>
    </tr>
    <tr>
        <th></th>
        <th>Part Number</th>
        <th>Nama Sparepart</th>
        <th>Stok</th>
        <th>Satuan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listRows as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->part_number }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->stok }}</td>
            <td>{{ $row->satuan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>