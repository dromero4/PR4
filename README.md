# Aplicació de Gestió d'Articles

Aquesta aplicacio està projectada a un sistema de gestió d'usuaris i de productes de padel (boles, pales, motxilles...), es treballa per inserir, modificar els diferents 
productes de la base de dades.

En cas d'estar loguejat, només surten els elements pujats per aquest usuari, i també només pot editar els seus propis elements.

La contrassenya es guarda a la base de dades encriptada amb hash.

Podem trobar `id`, `model`, `nom`, `preu` i `correu`.
A la secció d'usuaris hi podem trobar: `correu`, `usuari` i `contrassenya`.

## Estructura del Projecte

### Vista: Fitxers PHP

- **Formulari d'inserir**: Demana el títol i el cos per poder inserir-ho a la base de dades.
- **Formulari de modificar**: Demana l'ID del missatge, el títol i el cos per modificar l'article.
- **Formulari d'esborrar**: Demana l'ID de l'article i verifica si es vol esborrar finalment l'article.
- **Fitxer de consultar**: Mostra totes les entrades de la base de dades.
- **navbar.view.php**: Mostra els botons dels previs fitxers.
- **login.php**: Formulari per fer login.
- **signup.php**: Formulari per donar-se d'alta / registrar-se.
- **reiniciarPassword.php**: Formulari per reiniciar el password. (fill de login.php)

### Controlador: 
 - **Controlador.php**: On es controla absolutament tot.
 - **logout.php**: Fitxer per sortir de la sessio.
   
### Model:
- **Model.php**: fitxer on es guarden les funcions per accedir i gestionar la base de dades.

### Extra: 
- **connexio.php**: fitxer per poder connectar-se a la base de dades.
- **index.php**: fitxer inicial.
## Eines Utilitzades:
- **MySQL**
- **PHP**

## Base de Dades

La base de dades està exportada amb aquest fitxer.

<<<<<<< HEAD
[NOTE]:
- **Correu** prueba@prueba.com
- **Usuari** prueba
- **Contrassenya** davidD1234%

Encara que sempre pots crear el teu propi usuari.
=======
> [!NOTE]
> Correu: prueba@prueba.com <br>
> Usuari: prueba <br>
> Contrasenya: davidD1234% <br>
> Encara que sempre pots crear el teu propi usuari. <br>


> [!WARNING]
> PHP.ini modified in order to show the png QR
> 
> <img src="https://github.com/user-attachments/assets/eb911b96-b7e8-4c87-a8c1-eac7caafcdd6" width:120px>

>>>>>>> 3e65f9ebe89c011597cea6b562fbce92830e3680


[!WARNING]:
PHP.ini modified.

(https://github.com/dromero4/gif/blob/ef8acb425aa2764d8a32f894a93a7887a03891dd/GifReadMe.gif)

