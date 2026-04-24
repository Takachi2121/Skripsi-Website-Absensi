@forelse($getStatus as $key => $a)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $a->NIM }}</td>
    <td>{{ $a->namaMahasiswa }}</td>
    <td>{{ $a->kelas }}</td>
    <td>{{ $a->semester }}</td>
    <td>{{ $a->mataKuliah }}</td>
    <td>{{ $a->hari }}</td>
    <td>{{ $a->tgl_absen }}</td>
    <td>{{ $a->jam_absen }}</td>
    <td>
        @if($a->status == "Terlambat")
            <button class="btn btn-danger btn-sm">{{$a->status}}</button>
        @elseif($a->status == "Tidak Terlambat")
            <button class="btn btn-success btn-sm">{{$a->status}}</button>
        @elseif($a->status == "Tidak Absen")
            <button class="btn btn-dark btn-sm">{{$a->status}}</button>
        @endif
    </td>
    <td>
        <button onclick="deleteAbsensi('{{ $a->id }}')" class="btn btn-danger btn-sm">Hapus</button>
    </td>
    @empty
    <td colspan="11">Data Tidak Ada!</td>
</tr>
@endforelse
