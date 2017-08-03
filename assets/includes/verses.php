					<?php $verseArr = array (
					'John 14:6'=>'"Jesus answered, \'I am the way and the truth and the life. No one comes to the Father except through me\'"',
					'Ephesians 2:8'=>'"For it is by grace you have been saved, through faith – and this is not from yourselves, it is the gift of God"',
					'Philippians 4:13'=>'"I can do everything through Christ, who gives me strength."',
					'Proverbs 3:5-6'=>'"Trust in the LORD with all your heart and lean not on your own understanding; in all your ways acknowledge him, and he will make your paths straight."',
					'Romans 8:28'=>'"We know that all things work together for the good of those who love God: those who are called according to His purpose."',
					'Habakkuk 2:14'=>'"For the earth will be filled with the knowledge of the glory of the LORD as the waters cover the sea."',
					'Psalm 103:12'=>'"... as far as the east is from the west, so far has he removed our transgressions from us."',
					'John 16:33'=>'"I have told you these things, so that in me you may have peace. In this world you will have trouble. But take heart! I have overcome the world."',
					'Psalm 118:24'=>'"This is the day the LORD has made; let us rejoice and be glad in it."',
					'Ephesians 3:20'=>'"Now all glory to God, who is able, through his mighty power at work within us, to accomplish infinitely more than we might ask or think."'
					);
					$rand_key = array_rand($verseArr,1);
					$book = substr(strtolower($rand_key), 0, 3);
					
					if($book == 'joh') 
						$book = 'john';
					else if($book == 'phi') 
						$book = 'phil';
					else if($book == 'psa') 
						$book = 'ps';
					else if($book == 'pro') 
						$book = 'prov';
						
					preg_match("/ (\d+?):/", $rand_key, $chapters);
					
					echo '<a target="_blank" href="http://www.youversion.com/bible/'.$book.'.'.$chapters[1].'.niv">';
					echo '<p>'.$rand_key.'</p>
					<p>'.$verseArr[$rand_key].'</p>
					</a>';
					?>
