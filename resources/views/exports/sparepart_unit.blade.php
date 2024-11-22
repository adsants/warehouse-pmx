<table>
    
    <thead>
        <tr>
            <th colspan="7" align="center">
                <b>{{ $hull_number }} - {{ $type }} - {{ $model }}</b>
            </th>
        </tr>
    <tr>
        <th></th>
        <th>Tanggal</th>
        <th>Sparepart</th>
        <th>Qty</th>
        <th>Satuan</th>
        <th>Working Hour</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listRows as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->entry_date }}</td>
            <td>{{ $row->part_number }} - {{ $row->sparepartName }}  </td>
            <td>{{ $row->qty }}</td>
            <td>{{ $row->satuan }}</td>
            <td>{{ $row->working_hour }}</td>
            <td>{{ $row->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>