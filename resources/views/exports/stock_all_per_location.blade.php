<table>
    
    <thead>
    <tr>
        <th></th>
        <th>Lokasi</th>
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
            <td>{{ $row->locationName }}</td>
            <td>{{ $row->part_number }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->stock }}</td>
            <td>{{ $row->satuan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>