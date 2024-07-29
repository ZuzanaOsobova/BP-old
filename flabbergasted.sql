-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 11:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flabbergasted`
--

-- --------------------------------------------------------

--
-- Table structure for table `archetypes`
--

CREATE TABLE `archetypes` (
  `archetype_id` int(11) NOT NULL,
  `archetype_name` varchar(64) NOT NULL,
  `archetype_text` text NOT NULL,
  `archetype_readies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archetypes`
--

INSERT INTO `archetypes` (`archetype_id`, `archetype_name`, `archetype_text`, `archetype_readies`) VALUES
(1, 'The Aristocrat', 'As the ARISTOCRAT, you come from a titled family with all of the associated wealth and comfort. Perhaps you are the second child of a baron, freed from the responsibilities of a firstborn, while  till enjoying all of the pampering and luxury that comes with a title. Or maybe your insufferably nosy aunt is a duchess, and through her generosity, you are given a substantial monthly allowance to fund your lavish lifestyle. To be one of the aristocracies is to want for nothing; you have a fleet of attendants at your beck and call. Life for you is downing mint juleps over a game of baccarat, or spreading salacious gossip over tea and scones.', 80),
(2, 'The Staff', 'To play one of the STAFF is to be part of the growing service industry. You take great pride in your work and the ability to be self-reliant. As the staff, you can take on a role within a prominent (typically aristocratic) household, be employed by a business, or work independently and maintain your own clients. As a household staff member, you will be provided accommodation within the household or its grounds, along with a salary. Your role, whatever it may be, will also require you to look sharp, be constantly vigilant to rescue your hapless employer from any troubles, and anticipate their needs before they could even conceive they need them. You can take a job within the city, working as a concierge for one of the newly sprouted skyrises or work in a department store touting the latest fashion. You could also operate independently as a tutor or dressmaker whose talents are greatly sought after. \r\nWhatever your position, you are good at helping others and solving their problems, even if you aren’t obliged to \r\ndo so. What will everyone else do without your guiding hand?', 40),
(3, 'The Well-To-Do', 'A WELL-TO-DO is a salaried person of substantial income who’s climbing up the social ladder hoping to earn their place side-by-side with the gentry. As a Wellto-do, you take pride in your independence, resolve, and bold nature. You may have come into wealth in two main ways: you either worked your way up the ladder into a prestigious position, or you inherited great wealth, where you were given the freedom to explore your own interests and schooling. A high-salaried position could be anything from an entrepreneur to a politician, a doctor to an archaeologist.', 60),
(4, 'The Bohemian', 'Eternally in pursuit of music, art, liberty, and love, BOHEMIANS have chosen to abandon the mainstream and disdain materialism. Instead, they embrace a freespirited lifestyle with other kindred spirits. They’re essentially your sensitive artist type. Bohemians range wildly from a powerful vocalist looking to make it to the main stage, a misunderstood poet, a painter looking for their next use, or a travelling trapeze artist seeking excitement and enlightenment.', 50);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(64) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `cues`
--

CREATE TABLE `cues` (
  `cue_id` int(11) NOT NULL,
  `cue_name` varchar(64) NOT NULL,
  `cue_text` text NOT NULL,
  `archetype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cues`
--

INSERT INTO `cues` (`cue_id`, `cue_name`, `cue_text`, `archetype_id`) VALUES
(1, 'THROW A TANTRUM', 'As an Aristocrat, you are no stranger to causing a scene to get your way. Whine, caterwaul, and cause a ruckus. You’ll pause a disturbance and divert everyone’s attention to you. [+SCANDAL]', 1),
(2, 'DON’T YOU KNOW WHO I AM?', 'Name-drop your family title to either impress or intimidate. You throw about your social standing shamelessly to convince others of your lies, intimidate them into doing your bidding, or get them to overlook a misdeed. [+SCANDAL]', 1),
(3, 'A DAZZLING PERFORMANCE', 'Pick one instrument that you are very proficient in. You give an incredible\r\nperformance. [+DIGNITY]', 1),
(4, 'VIRTUOUS BEYOND REPROACH', 'You are unshaken in your morals and take pride in your virtue. When faced with the temptation to give into your basest desires, you stand strong. Everyone fears a moral chastising from you. [+DIGNITY]', 1),
(5, 'SOPHISTICATED CHARM', 'You never go stag anywhere. When you turn your charm on, people become hopelessly enamoured with you. Be warned; you’re likely to have a string of admirers if you keep this up. [+SCANDAL]', 1),
(6, 'FRIENDS IN HIGH PLACES', 'Flatter a distinguished individual to make them more amenable. Haughty folk are easily cajoled into anything with a little bit of flattery. Well, almost anything.', 1),
(7, 'A SURPRISING SKILL', 'You have a lot of time on your hands and have developed unorthodox skills that never fail to impress (or unnerve) those around you. Pick one unusual craft or skill that you are proficient in.', 1),
(8, 'THE PERFECT HOST', 'You’ve planned and organised many galas, fêtes, and dinners. You know which vendor will help you in a pinch and are certain that there’s no item you cannot source. [+DIGNITY]', 1),
(9, 'PATRON OF THE ARTS', 'Share your appreciation of the arts with any performer or artist. They will be willing to do just about anything to secure your patronage. [+DIGNITY]', 1),
(10, 'WELL-READ', 'With a good education, a diverse library\r\nat home, and plenty of idle time, you find yourself very knowledgeable on certain topics. You may impress those around you with your knowledge or recall an important\r\npiece of information to aid you in a crisis. Pick one subject matter that you are proficient in.', 1),
(11, 'I HEARD A RUMOUR...', 'The Director will impart on you a piece of gossip. If this is true or relevant to your situation, you will have to find out for yourself. Alternatively, you can spread your own piece of gossip. The more scandalous, the better.', 1),
(12, 'PERFECT MANNERS', 'You showcase a brilliant display of etiquette and manners. You succeed in charming everyone around you. [+DIGNITY]', 1),
(13, 'CALL ON THE STAFF', 'The staff are always at your beck and call. Engage with any nearby attendants, and they will do as you request without question…unless it’s unreasonable.', 1),
(14, 'TOAST OF THE TOWN', 'You’re the life and soul of the party. Your personality is practically intoxicating, and everyone around you celebrates with reckless abandon. [+SCANDAL]', 1),
(15, 'LUCKY BREAK', 'For whatever reason, life just has a way of working out for you. You automatically succeed on a failed roll of your choice. (Describe how, despite your failure, you still managed to come out on top.)', 1),
(16, 'UNFLAPPABLE', 'Your years of working with different employers and customers mean you’ve endured your fair share of tantrums and threats. Through your experience, you know how to keep your cool and stand your ground. You cannot be intimidated. [+DIGNITY]', 2),
(17, 'THIS WAY, PLEASE', 'Your years of employment in everything from grand manors to large department stores means that you can accurately intuit the layout of a building, including the rooms that many would rather keep a secret.', 2),
(18, 'LEND A HELPING HAND', 'If you know something to be true about all service employees, it is that they always have too much to do. Do a favour for one of your fellow workers so you can call one in later.', 2),
(19, 'A GUIDING HAND', 'You’ve secured the trust and respect of the gentry; they trust you implicitly. You can get aristocrats to agree with you or do your bidding…even if it’s not necessarily in their best interest. [+SCANDAL]', 2),
(20, 'DEVIL IN THE DETAILS', 'You have mastered the art of subtle sabotage. Tweak and modify things in a way to cause some misfortune or embarrassment down the line without drawing any attention to yourself.', 2),
(21, 'UNSEEN & UNNOTICED', 'You know that most residents don’t pay you much attention. You can quickly blend into your surroundings and move about while avoiding detection.', 2),
(22, 'ONE STEP AHEAD', 'You’ve developed a sharp mind and a keen eye in the effort to anticipate an employer or client’s needs. When coming up with a plan, you can closely assess it and point out any obvious shortcomings. The Director will point out to you any issues with the plan.', 2),
(23, 'SOOTHING TOUCH', 'Hangover cures, stubborn colds, little cuts, bumps and bruises: you have a remedy for all and a soothing nature to go along with it. You can heal anyone who’s injured or scuffed to one status above. [+DIGNITY]\r\n', 2),
(24, 'WHIMS AND FANCIES', 'You’re used to fulfilling unreasonable requests on a whim. No matter the time or place, you know just where to go to find what you need. You get to create the NPC you need at that moment and place them in the city.', 2),
(25, 'THE WALLS HAVE EARS', 'Down in the service quarters and break rooms, gossip spreads like wildfire. You can pick up on any rumours and secrets that you hear from the grapevine. Alternatively, you can use this to start a rumour and let it spread. [+SCANDAL]', 2),
(26, 'SPECIALITY', 'You have a working knowledge of a lot of useful skills, but there’s one in particular that you are known for. Every time you perform this feat, you impress all around you. [+DIGNITY]\r\n', 2),
(27, 'A DIGNIFIED DISPLAY', 'You are an expert in manners and decorum. Your dignity impresses those around you, leading them to regard you highly. [+DIGNITY]\r\n', 2),
(28, 'A SURPRISING SKILL', 'You went through many different careers and experiences in your time. As such, you’ve picked up a few unique skills that never fail to impress (or unnerve) those around you. Pick one unusual craft or skill that you are proficient in.', 2),
(29, 'A STITCH IN TIME', 'You’re resourceful and cool-headed under pressure. You can quickly makeshift a disguise or repair a broken garment.', 2),
(30, 'DISARMING CHARM', 'You keenly turn on your charm to make yourself irresistible. Be aware with whom you entangle; it might get messy. [+SCANDAL]\r\n', 2),
(31, 'BROWN NOSER', 'You’re no stranger to sucking up; it’s how you managed to get to where you are now. With enough grovelling, you can get anyone to help you out. Your forward nature leaves a bad impression, but it gets the job done. [+SCANDAL]', 3),
(32, 'V.I.P.', 'You’re well known around town and tend to get recognised or often run into old friends. You can usually find a familiar face or someone eager to schmooze with you wherever you are. Exclusive places will also extend invitations to you. [+DIGNITY]', 3),
(33, 'STREET SMARTS', 'You’ve worked your way to the top, but you’ll never forget where you started. Commonplace citizens, ragamuffins, and even gangsters are much more amenable to you and willing to help. [+SCANDAL]', 3),
(34, 'LUCKY BREAK', 'Luck has always been on your side. Even when something goes bad, you can usually find a way to make it work for you. You automatically succeed on a failed roll of your choice. (Describe how, despite your failure, you still managed to come out on top.)', 3),
(35, 'SILVER SPOON', 'You may not be an aristocrat, but being born into a wealthy family meant you moved in the same circles. Aristocrats and other affluent people will be amenable to helping you out.', 3),
(36, 'FASTIDIOUS', 'You and your friends have just concocted a cunning plan. Carefully study the plan and point out any obvious shortcomings. The Director will advise you on any flaws in your plan.', 3),
(37, 'A SURPRISING SKILL', 'Over the years, you’ve met several interesting people and picked up on some of their quirks. Pick one unusual skill or craft that you are proficient in.', 3),
(38, 'PATCH YOU UP', 'You’re trained in the noble profession of medicine. If you or one of your friends have reached an injured or scuffed status, you can patch them back up to one status above. [+DIGNITY]', 3),
(39, 'THE ACADEMIC', 'You are well respected in academic circles and you impress those around you with your\r\nextensive knowledge. You can also recall important information to aid you in a predicament. [+DIGNITY]', 3),
(40, 'I AM THE LAW', 'You’re well versed with the rules of law and know how to wield this knowledge to your advantage. Impress and intimidate with your legalese while finding loopholes to get you out of unfavourable situations.', 3),
(41, 'HEADSTRONG', 'Everyone knows to steer clear of you when an argument is breaking out. You can win any argument and come out on top. If you believe strongly in something, no one can make you change your mind. [+SCANDAL]', 3),
(42, 'CITY SLICKER', 'You know the city like the back of your hand. You know where to find the right people for the right deal. You get to create an NPC that you need at that moment and place them in the city.', 3),
(43, 'I’LL GIVE YOU AN IOU', 'Get someone to do you a big favour or help you out of a bind. You offer them a favour in return. What that favour is or when they plan to collect, you’ll have to find out for yourself.', 3),
(44, 'TOUGH NEGOTIATOR', 'You know a thing or two about running a business. You can get anyone to drop their price or give you a better deal. [+SCANDAL]', 3),
(45, 'DEVILISHLY CHARMING', 'From smouldering looks to pick up lines, you know how to turn on the charm. Be warned, you might end up with too many love stricken admirers vying for your affection. [+SCANDAL]', 3),
(46, 'I READ THAT IN A BOOK', 'You love burying yourself in a good book. The more obscure and niche, the better. You can recall obscure facts and make comparisons that most people would never even think of. It’s both impressive and obnoxious. [+DIGNITY]', 4),
(47, 'A DIFFERENT PERSPECTIVE', 'You have a creative way of looking at the world. When concocting a plan, the Director will offer up some unique approaches you might want to consider or point out an interesting and overlooked detail.', 4),
(48, 'KINDRED SPIRITS', 'You quickly form a deep connection with any like-minded artists and performers. You know that if you are ever in need, your fellow artists will come to your aid without a second thought.', 4),
(49, 'THE PERFECT PROTEGE', 'As an artist, you depend on the patronage of noble and affluent people. Luckily you know just the right thing to say to make your work highly desirable. People with money to burn and a reputation to uphold enjoy your company and are amenable to you. [+DIGNITY]', 4),
(50, 'WAX POETIC', 'You tend to be overly verbose and dramatic when you speak. Depending on with whom you’re speaking, they can either be very charmed or completely drained by the end.', 4),
(51, 'A PASSIONATE DISPLAY', 'Pick an artistic skill that you are very proficient in. You give a passionate display every time you perform. All eyes are on you. [+DIGNITY]', 4),
(52, 'ARTS AND CRAFTS', 'You can whip up just about anything with some paste, scrap fabric, and a dab of paint.', 4),
(53, 'FRIENDS IN LOW PLACES', 'In your pursuit of art, you’ve enjoyed the company of all manner of people, even with ones deemed unsavoury. If you ever need help with something not entirely legal, you know exactly who will help you out. [+SCANDAL]', 4),
(54, 'GOOD TASTE', 'You offer your aesthetic perspective, whether it was asked for or not. Your advice is invaluable in making something infinitely more appealing. [+DIGNITY]\r\n', 4),
(55, 'A SURPRISING SKILL', 'After spending time in artistic circles, you picked up on some unique and interesting skills that never fail to impress (or unnerve) those around you. Pick one unusual craft or skill that you are proficient in.', 4),
(56, 'GO AGAINST THE GRAIN', 'You have strong views and opinions that most people would find shocking and wholly inappropriate. Because you speak about these matters with such conviction, you can convince anyone to agree with you. [+SCANDAL]', 4),
(57, 'LIFE OF THE PARTY', 'No one parties like a bohemian. Your events have the best music, dancing, costumes, and decor. You can turn any boring, lifeless affair into a wild and uproarious party. [+SCANDAL]', 4),
(58, 'EXISTENTIAL CRISIS', 'Your mind constantly pursues universal truths and questions the world around you. You share this experience with someone until you make them question their place in the world and everything they thought to be true.', 4),
(59, 'WANDERER', 'You find that the best thing to do when you are at a loss is to let yourself wander…You follow your artistic soul, and somehow, you end up at the exact place you need to be. The Director will lead you to a new location.', 4),
(60, 'EFFORTLESSLY CHARMING', 'There’s an alluring quality about you that draws people in and keeps them entranced. If you play into this, you can charm just about anyone who shows an interest. Be warned, they’re likely to become hopelessly enamoured by you. [+SCANDAL]', 4);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(64) NOT NULL,
  `group_info` text NOT NULL COMMENT 'lokace, popis, slogan, téma, prezident atd.',
  `group_description` text NOT NULL,
  `group_trouble` text NOT NULL,
  `group_renown` int(11) NOT NULL,
  `group_readies` int(11) NOT NULL,
  `group_trophies` int(11) NOT NULL,
  `group_den` text NOT NULL,
  `group_updates` int(11) NOT NULL COMMENT 'opt in/out'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `note_name` text NOT NULL,
  `note_text` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `protagonists`
--

CREATE TABLE `protagonists` (
  `protagonist_id` int(11) NOT NULL,
  `protagonist_name` varchar(256) NOT NULL,
  `archetype_id` int(11) NOT NULL COMMENT 'what class they are',
  `protagonist_info` text NOT NULL COMMENT 'age, profession, title, relationship, nickname',
  `protagonist_description` text NOT NULL,
  `protagonist_mementos` text NOT NULL,
  `protagonist_flaw` text NOT NULL COMMENT 'Either pick from possibles during making process or their own',
  `protagonist_dilemma` text NOT NULL,
  `protagonist_background` text NOT NULL,
  `protagonist_readies` int(11) NOT NULL,
  `protagonist_standing` int(11) NOT NULL,
  `protagonist_status` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `rel_group_upgrade`
--

CREATE TABLE `rel_group_upgrade` (
  `group_upgrade_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `upgrade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `rel_protagonist_cue`
--

CREATE TABLE `rel_protagonist_cue` (
  `protagonist_cue_id` int(11) NOT NULL,
  `protagonist_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  `protagonist_cue_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `rel_protagonist_trait`
--

CREATE TABLE `rel_protagonist_trait` (
  `protagonist_trait_id` int(11) NOT NULL,
  `protagonist_id` int(11) NOT NULL,
  `trait_id` int(11) NOT NULL,
  `protagonist_trait_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `rel_user_group`
--

CREATE TABLE `rel_user_group` (
  `user_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `traits`
--

CREATE TABLE `traits` (
  `trait_id` int(11) NOT NULL,
  `trait_name` text NOT NULL,
  `trait_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traits`
--

INSERT INTO `traits` (`trait_id`, `trait_name`, `trait_text`) VALUES
(1, 'Bravado & Persuasion', 'Add bonus +1 if you are a Well-To-Do.\r\nThis trait is reflective of the Protagonist’s CONFIDENCE and SHOW OF STRENGTH, as well as their ability to convince all those around them of their surety. You might use this trait to try and persuade the cops to arrest your rival instead of yourself. Perhaps you’re trying to loudly voice your complaints at the theatre in the hopes that your entrance fee will be waived off.'),
(2, 'Culture & Etiquette', 'Add bonus +1 if you\'re The Aristocrat.\r\nThis trait reflects how WELL READ and WELL MANNERED the Protagonist is and whether they know their salad fork from their dessert fork. Perhaps you are at a dinner trying to draw all eyes on you with your impeccable manners, or you need to give an exemplary speech to raise a substantial amount for charity.'),
(3, 'Wit & Sharp', 'Add bonus +1 if you\'re The Staff.\r\nThis trait reflects how ASTUTE, CLEVER, and QUICK-THINKING the Protagonist is. This trait can also be used to show how fastidious and precise they are. You could use this trait to predict your opponent’s next move and win your chess game. Maybe you’ve found yourself in a high-speed car chase and use your impeccable recall to navigate some side streets and lose the car behind you'),
(4, 'Creativity & Passion', 'Add bonus +1 if you\'re the Bohemian.\r\nThis trait reflects how CREATIVE the Protagonist is. It can be used to find a creative solution to a problem, share one’s aesthetic expression, or put on a good show through a PASSIONATE PERFORMANCE. You might use this trait to share your sartorial expertise with a friend and ensure they are dressed to impress or give an astounding performance that people will recall for weeks.');

-- --------------------------------------------------------

--
-- Table structure for table `upgrades`
--

CREATE TABLE `upgrades` (
  `upgrades_id` int(11) NOT NULL,
  `upgrades_name` text NOT NULL,
  `upgrades_text` text NOT NULL,
  `upgrades_requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upgrades`
--

INSERT INTO `upgrades` (`upgrades_id`, `upgrades_name`, `upgrades_text`, `upgrades_requirements`) VALUES
(1, 'TROPHY ROOM', 'Display your trophies proudly in your Social Club!', 'Any renown level | 100 readies + Successfully complete your first public challenge'),
(2, 'DRESSING ROOM', 'The Protagonists may take on any appearance that they may need at any moment. Fashion show? Got you. Formal dinner? No sweat. Tennis match against the third Earl of Hauntington? Right this way', 'Level 2 renown | 150 readies'),
(3, 'PRINTING PRESS', 'Tired of accepting other clubs’ public challenges and following their rules? Issue your own public challenge with your very own printing press! You cannot issue your own public challenge until you get this club upgrade.', 'Level 3 renown | 150 readies'),
(4, 'FORMAL DINING ROOM', 'Allows Protagonists’ trait culture & etiquette to be raised above 4 to a maximum cap of 8.', 'Level 4 renown | 200 readies'),
(5, 'GAMES ROOM', 'Allows Protagonists’ bravado & persuasion to be raised above 4 to a maximum cap of 8.', 'Level 4 renown | 200 readies'),
(6, 'LIBRARY', 'Allows Protagonists’ wit & sharp to be raised above 4 to a maximum cap of 8.', 'Level 4 renown | 200 readies'),
(7, 'STUDIO', 'Allows Protagonists’ creativity & passion to be raised above 4 to a maximum cap of 8', 'Level 4 renown | 200 readies'),
(8, 'DANCE HALL', 'The Social Club can now host its very own events, balls, and galas. For each instance that it is used, all Protagonists gain +1 dignity. Limited to 1 use per session', 'Level 5 renown | 300 readies'),
(9, 'CABARET HALL', 'The Social Club can now gather in lavish and salacious evenings of delight as they host cabaret, gambling nights, and other such events. For each instance that it is used, all Protagonists gain +1 scandal. Limited to 1 use per session.', 'Level 5 renown | 300 readies'),
(10, 'TRIPLE PANEL FULL LENGTH MIRROR', 'You get very comfortable talking to yourself in the mirror. Who wouldn’t love this gorgeous face? All Protagonists get substantially better at flirting. Gain the scene cue (or add an additional use) DISARMING CHARM, DEVILISHLY CHARMING, SOPHISTICATED CHARM, or EFFORTLESSLY CHARMING, whichever is available for your archetype.', 'Level 5 renown | 100 readies'),
(11, 'WEST WING', 'The Social Club expands and can now host more than 50 members to a maximum cap of 100.', 'Level 5 renown | 400 readies'),
(12, 'GARAGE', 'The Social Club can now hold a vehicle of your choice. You’ll always have it on hand for any adventures around Peccadillo.', 'Level 6 renown | 350 readies'),
(13, 'THE OUTLET', 'The Social Club keeps an outlet of their choice that generates income! Perhaps your tea club opens a tea shop? Or your occult club offers tarot and palmistry reading? Your Social Club will earn 30 x renown in club funds during the CLOSING CREDITS. For instance, your Social Club has 6 renown and therefore will earn 180 readies in its funds during the episode’s closing credits', 'Level 6 renown | 400 readies'),
(14, 'WATERING HOLE', 'Who doesn’t love some good gossip? Come by the watering hole and learn an important piece of gossip (told by the Director) or share some gossip and let it spread to every corner of Peccadillo. The more scandalous, the better.', 'Level 6 renown | 200 readies'),
(15, 'TRAINING ROOM', 'Allows Protagonists to increase any character trait automatically by 1.', 'Level 7 renown | 300 readies'),
(16, 'HOBBY ROOM', 'All Protagonists get the scene cue (or adds an additional use) of A SURPRISING SKILL!', 'Level 7 renown | 200 readies'),
(17, 'THE SUMMER HOUSE', 'The Social Club keeps a small summer house in a location of the players’ choosing. This becomes a location and a safe space.', 'Level 10 renown | 700 readies'),
(18, 'SWIMMING POOL', 'What? It’s a swimming pool. In a club. Is that not enough for you?', 'Level 13 renown | 500 readies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Indexes for dumped tables
--

--
-- Indexes for table `archetypes`
--
ALTER TABLE `archetypes`
  ADD PRIMARY KEY (`archetype_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `geoup_category` (`group_id`);

--
-- Indexes for table `cues`
--
ALTER TABLE `cues`
  ADD PRIMARY KEY (`cue_id`),
  ADD KEY `archetype_cues` (`archetype_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `category_note` (`category_id`),
  ADD KEY `group_note` (`group_id`);

--
-- Indexes for table `protagonists`
--
ALTER TABLE `protagonists`
  ADD PRIMARY KEY (`protagonist_id`),
  ADD KEY `protagonist_archetype` (`archetype_id`),
  ADD KEY `protagonist_group` (`group_id`);

--
-- Indexes for table `rel_group_upgrade`
--
ALTER TABLE `rel_group_upgrade`
  ADD PRIMARY KEY (`group_upgrade_id`),
  ADD KEY `group_upgrade_group_id` (`group_id`),
  ADD KEY `group_upgrade_upgrade_id` (`upgrade_id`);

--
-- Indexes for table `rel_protagonist_cue`
--
ALTER TABLE `rel_protagonist_cue`
  ADD PRIMARY KEY (`protagonist_cue_id`),
  ADD KEY `protagonist` (`protagonist_id`),
  ADD KEY `cue` (`cue_id`);

--
-- Indexes for table `rel_protagonist_trait`
--
ALTER TABLE `rel_protagonist_trait`
  ADD PRIMARY KEY (`protagonist_trait_id`),
  ADD KEY `protagonist_trait_protagonist_id` (`protagonist_id`),
  ADD KEY `protagonist_trait_trait_id` (`trait_id`);

--
-- Indexes for table `rel_user_group`
--
ALTER TABLE `rel_user_group`
  ADD PRIMARY KEY (`user_group_id`),
  ADD KEY `user_group_user_id` (`user_id`),
  ADD KEY `user_group_group_id` (`group_id`);

--
-- Indexes for table `traits`
--
ALTER TABLE `traits`
  ADD PRIMARY KEY (`trait_id`);

--
-- Indexes for table `upgrades`
--
ALTER TABLE `upgrades`
  ADD PRIMARY KEY (`upgrades_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archetypes`
--
ALTER TABLE `archetypes`
  MODIFY `archetype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cues`
--
ALTER TABLE `cues`
  MODIFY `cue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `protagonists`
--
ALTER TABLE `protagonists`
  MODIFY `protagonist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rel_group_upgrade`
--
ALTER TABLE `rel_group_upgrade`
  MODIFY `group_upgrade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rel_protagonist_cue`
--
ALTER TABLE `rel_protagonist_cue`
  MODIFY `protagonist_cue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rel_protagonist_trait`
--
ALTER TABLE `rel_protagonist_trait`
  MODIFY `protagonist_trait_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rel_user_group`
--
ALTER TABLE `rel_user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `traits`
--
ALTER TABLE `traits`
  MODIFY `trait_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upgrades`
--
ALTER TABLE `upgrades`
  MODIFY `upgrades_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `geoup_category` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `cues`
--
ALTER TABLE `cues`
  ADD CONSTRAINT `archetype_cues` FOREIGN KEY (`archetype_id`) REFERENCES `archetypes` (`archetype_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `category_note` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `group_note` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `protagonists`
--
ALTER TABLE `protagonists`
  ADD CONSTRAINT `protagonist_archetype` FOREIGN KEY (`archetype_id`) REFERENCES `archetypes` (`archetype_id`),
  ADD CONSTRAINT `protagonist_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `rel_group_upgrade`
--
ALTER TABLE `rel_group_upgrade`
  ADD CONSTRAINT `group_upgrade_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `group_upgrade_upgrade_id` FOREIGN KEY (`upgrade_id`) REFERENCES `upgrades` (`upgrades_id`);

--
-- Constraints for table `rel_protagonist_cue`
--
ALTER TABLE `rel_protagonist_cue`
  ADD CONSTRAINT `cue` FOREIGN KEY (`cue_id`) REFERENCES `cues` (`cue_id`),
  ADD CONSTRAINT `protagonist` FOREIGN KEY (`protagonist_id`) REFERENCES `protagonists` (`protagonist_id`);

--
-- Constraints for table `rel_protagonist_trait`
--
ALTER TABLE `rel_protagonist_trait`
  ADD CONSTRAINT `protagonist_trait_protagonist_id` FOREIGN KEY (`protagonist_id`) REFERENCES `protagonists` (`protagonist_id`),
  ADD CONSTRAINT `protagonist_trait_trait_id` FOREIGN KEY (`trait_id`) REFERENCES `traits` (`trait_id`);

--
-- Constraints for table `rel_user_group`
--
ALTER TABLE `rel_user_group`
  ADD CONSTRAINT `user_group_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `user_group_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
