@if(session('saveDraft'))
    <div class="bg-blue-200 border-t border-b border-blue-500 text-blue-700 text-center px-4 py-3 font-bold">
        {{ session('saveDraft') }}
    </div>
@elseif(session('release'))
    <div class="bg-green-200 border-t border-b border-green-500 text-green-700 text-center px-4 py-3 font-bold">
        {{ session('release') }}
    </div>
@elseif(session('reservationRelease'))
    <div class="bg-amber-200 border-t border-b border-amber-500 text-amber-700 text-center px-4 py-3 font-bold">
        {{ session('reservationRelease') }}
    </div>
@endif


@if(session('updateSaveDraft'))
    <div class="bg-blue-200 border-t border-b border-blue-500 text-blue-700 text-center px-4 py-3 font-bold">
        {{ session('updateSaveDraft') }}
    </div>
@elseif(session('updateRelease'))
    <div class="bg-green-200 border-t border-b border-green-500 text-green-700 text-center px-4 py-3 font-bold">
        {{ session('updateRelease') }}
    </div>
@elseif(session('updateReservationRelease'))
    <div class="bg-amber-200 border-t border-b border-amber-500 text-amber-700 text-center px-4 py-3 font-bold">
        {{ session('updateReservationRelease') }}
    </div>
@endif


@if(session('moveTrash'))
    <div class="bg-violet-200 border-t border-b border-violet-500 text-violet-700 text-center px-4 py-3 font-bold">
        {{ session('moveTrash') }}
    </div>
@elseif(session('restore'))
    <div class="bg-sky-200 border-t border-b border-sky-500 text-sky-700 text-center px-4 py-3 font-bold">
        {{ session('restore') }}
    </div>
@elseif(session('delete'))
    <div class="bg-red-200 border-t border-b border-red-500 text-red-700 text-center px-4 py-3 font-bold">
        {{ session('delete') }}
    </div>
@endif
