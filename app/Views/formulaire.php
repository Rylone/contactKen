<form method="POST" action="<?php echo base_url('/Formulaire/index') ?>">

<input type="hidden" name="monformulaire" value="true"></input>

Nom : <input type="text" name="nom"></input>

<br><br>

<?php if (isset($validation) && $validation->hasError('nom') && $request->getVar('monformulaire') =='true') { 
    
    echo $validation->getError('nom');
    
}?>

<br><br>

Prenom : <input type="text" name="prenom"></input>

<br><br>

<?php if (isset($validation) && $validation->hasError('prenom') && $request->getVar('monformulaire') =='true') { 
    
    echo $validation->getError('prenom');
    
}?>
 <input type="email" name="email"></input>

<br><br>

<?php if (isset($validation) && $validation->hasError('email') && $request->getVar('monformulaire') =='true') { 
    
    echo $validation->getError('email');
    
}?>

<br><br>


<button type="submit">Envoyer</button>

</form>