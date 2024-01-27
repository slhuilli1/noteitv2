<?php
	defined('_JEXEC') or die('Access deny');

	class plgContentNoteIt extends JPlugin 
	{
		function onContentPrepare($content, $article, $params, $limit){	
			/*UTILISATION : 
			{note "Libelle de la note (titre)"}
			ceci est le libellé de ma note
			{/note}
			*/
			
			$document = JFactory::getDocument();
			$document->addStyleSheet('plugins/content/noteit/style.css');
			
			$re = '/\{.*notedoc.*,(.*),(.*)}(.*){\/notedoc}/sU';

			preg_match_all($re, $article->text, $matches, PREG_SET_ORDER, 0);

			//Comme j'ai besoin de savoir le premier et dernier elemnt pour mettre mon premier div "les-post-it", je We en comptant
			$nb = count($matches);
			
			foreach($matches as $P)
			{

					//Pour chaque occurence trouvee, on remplace le truc
					if ($i==0) //Si c'est le premier tour de boucle, il faut ouvrir la zonr de post it
					{
						$STR = '<div class="les-post-it">';
					}
						
					//Puis je cree les post-it
					if($P[2]=="green")
					{
						$STR .= '<div class="notes-article-vert">
									<div class="titre-sticky">'.$P[1].'</div>
									<div class="contenu-sticky">TOTO '.$P[2].' - '.$P[3].' </div>
								';//Le DIV se ferme dans i=0 ? En tout cas pas ici !
					}
					else
					{
						$STR .= '<div class="notes-article">
									<div class="titre-sticky">'.$P[1].'</div>
									<div class="contenu-sticky">Toto  '.$P[2].' - '.$P[3].'  </div>
								';//Le DIV se ferme dans i=0 ? En tout cas pas ici !
					}
						
						
					if ($i==0) //Si c'est le premier tour de boucle, il faut ouvrir la zonr de post it
					{
						$STR .= '</div>';
					}	
						
						
					$article->text = str_replace($P[0],$STR,$article->text);
					
					//$i++;

			}
			//$article->text  =str_replace($ligne[0],$a, $article->text);
					   
			}
			
	}
	
	
