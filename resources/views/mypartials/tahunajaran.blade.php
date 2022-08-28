@if (request('tahun_awal'))
<input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
@endif
@if (request('tahun_akhir'))
<input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
@endif
@if (request('semester'))
<input type="hidden" name="semester" value="{{ request('semester') }}">
@endif