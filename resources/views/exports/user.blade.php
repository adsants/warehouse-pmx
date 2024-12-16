<table>
    
    <thead>
    <tr>
        <th scope="col">Nama</th>
        <th scope="col">Username</th>
        <th scope="col">Kategori User</th>
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