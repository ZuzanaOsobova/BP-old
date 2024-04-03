-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 05:01 PM
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
  `archetype_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `upgrades`
--

CREATE TABLE `upgrades` (
  `upgrades_id` int(11) NOT NULL,
  `upgrades_name` text NOT NULL,
  `upgrades_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `archetype_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cues`
--
ALTER TABLE `cues`
  MODIFY `cue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `protagonists`
--
ALTER TABLE `protagonists`
  MODIFY `protagonist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rel_group_upgrade`
--
ALTER TABLE `rel_group_upgrade`
  MODIFY `group_upgrade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rel_protagonist_trait`
--
ALTER TABLE `rel_protagonist_trait`
  MODIFY `protagonist_trait_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rel_user_group`
--
ALTER TABLE `rel_user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `traits`
--
ALTER TABLE `traits`
  MODIFY `trait_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upgrades`
--
ALTER TABLE `upgrades`
  MODIFY `upgrades_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

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
