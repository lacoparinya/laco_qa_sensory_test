@extends('layouts.print')

@section('content')
    <div  class="row" >
        <div class="col-md-3" style="border:1px solid black; text-align:center;">
            @php
                $url = url('/sensory/runtest/' . $sensorymaster->id);
                echo QrCode::size(250)->generate($url);
            @endphp
        </div>
    </div>
    <div  class="row" >
        @foreach ($sensorymaster->sensoryDetail as $item)
    <div class="col-md-1" style="border:1px solid black">{{ $item->code }}</div>
        @endforeach
        
    </div>
                
            </td>
        </tr>
    </table>
    
@endsection