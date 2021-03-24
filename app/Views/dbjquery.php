<button class='btn one'>toggle</button>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam omnis, obcaecati velit enim esse voluptatibus cupiditate. Incidunt nostrum quia iure ad. Laborum dolor itaque aspernatur, reiciendis cumque exercitationem illo tempore?</p>
<button class='btn two'>toggle</button>
<hr>
<button class="btn tree"> ADD TOP </button>
<ul class='ul'>
<?php 
if(!empty($allContacts))
{
    foreach($allContacts as $contact)
    {
        echo "<li>".$contact['first_Name'].' <a href="'.base_url("dbandjquery/delete/".$contact['id']).'">X</a></li>';
    }
}
?>
</ul>
<li class="waiting ">Veuillez patienter </li>
<button class="btn next"> Next </button><button class="btn previous"> Previous </button>


<button class="btn btn4"> ADD BUTTON </button>
<BR></BR>
<hr>
<form >
    <input type="text" name="prenom">
    <button class="go">Go go go ! </button>
</form>
