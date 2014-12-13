<?PHP
function sortfunc($field, $title, $sort, $sortrule, $urlsort)
{
    $newsortrule = 'asc';
    $r = '';
    if($sort == $field):
        if($sortrule == 'asc'):
            $r .= '<i class="icon-arrow-up"></i>'.$title.'</a>';
            $newsortrule = 'desc';
        else:
            $r .= '<i class="icon-arrow-down"></i>'.$title.'</a>';
            $newsortrule = 'asc';
        endif;
    else:
        $r .= $title.'</a>';
    endif;    
    $r0 = '<a href="'.$urlsort.$field.'/'.$newsortrule.'" class="btn btn-block">';
    $r = $r0.$r;
    return $r;
}
?>
<div class="mf">
<div><h3>Отзывы:</h3></div>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>
            <?PHP echo sortfunc('name', 'name', $sort, $sortrule, $urlsort); ?>
            </th>
            <th>
            <?PHP echo sortfunc('email', 'e-mail', $sort, $sortrule, $urlsort); ?>
            </th>
            <th>
            <?PHP echo sortfunc('created', 'created', $sort, $sortrule, $urlsort); ?>
            </th>
            <th>edited</th>
            <th>read</th>
        </tr>
    </thead>
    <tbody>
        <?PHP foreach($rvs as $rv): ?>
         <tr>
            <td><?PHP echo $rv->id; ?></td>
            <td><a href="<?PHP echo $urledit.$rv->id; ?>"><?PHP echo $rv->name; ?></a></td>
            <td><?PHP echo $rv->email; ?></td>
            <td><?PHP echo date('Y-m-d H:i:s', $rv->created); ?></td>
            <td><?PHP
            if($rv->edited != 0):
                echo date('Y-m-d H:i:s', $rv->edited);
            endif;
            ?></td>
            <td><?PHP echo $rv->read; ?></td>
         </tr>
        <?PHP endforeach; ?>
    </tbody>
</table>
</div>