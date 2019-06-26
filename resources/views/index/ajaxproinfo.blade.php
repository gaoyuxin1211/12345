
    
     <table border="0">
       评论区 ↓  ↓<br>
       <span>--------------------------------------------------------------------------------------------------------</span>

      @foreach($dat as $k=>$v)
       <tr>

         <td>{{$v->p_dengji}} &nbsp;&nbsp;&nbsp;</td>
         <td> &nbsp;&nbsp;&nbsp;{{$v->p_content}} &nbsp;&nbsp;&nbsp;</td>
         <td>&nbsp;&nbsp;&nbsp; 匿名用户 &nbsp;&nbsp;&nbsp;</td>
         <td>&nbsp;&nbsp;&nbsp; {{$v->p_email}} &nbsp;&nbsp;&nbsp;</td>
         <td style="font-size:12px">&nbsp;&nbsp;&nbsp; {{$v->p_time}}&nbsp;&nbsp;&nbsp; </td>
       </tr>
      @endforeach
      <tr>
        <td clospan="4">{{$dat->links()}}</td>
      </tr>
     </table>
  