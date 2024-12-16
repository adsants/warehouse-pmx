<table>
    
    <thead>
    <tr>
        <th>Nama</th>
        <th>Username</th>
        <th>Kategori User</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listRows as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>
                @forelse ($row->getRoleNames() as $role)
                {{ $role }}
                @empty
                @endforelse
            </td>
        </tr>
    @endforeach
    </tbody>
</table>