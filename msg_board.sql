/*
 Navicat Premium Data Transfer

 Source Server         : loc
 Source Server Type    : PostgreSQL
 Source Server Version : 90503
 Source Host           : localhost
 Source Database       : test_core
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90503
 File Encoding         : utf-8

 Date: 08/10/2016 20:35:50 PM
*/

-- ----------------------------
--  Table structure for msg_board
-- ----------------------------
DROP TABLE IF EXISTS "public"."msg_board";
CREATE TABLE "public"."msg_board" (
	"name" varchar COLLATE "default",
	"phone" varchar COLLATE "default",
	"mail" varchar COLLATE "default",
	"message" varchar COLLATE "default",
	"date" timestamp(6) WITH TIME ZONE DEFAULT now(),
	"id" int4 NOT NULL DEFAULT nextval('msg_board_id_seq'::regclass)
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."msg_board" OWNER TO "paolo";

-- ----------------------------
--  Records of msg_board
-- ----------------------------
BEGIN;
INSERT INTO "public"."msg_board" VALUES ('sdfgh', '7654', 'ertf', 'jfgds', '2016-08-10 01:59:25+03', '1');
INSERT INTO "public"."msg_board" VALUES ('jhgfdfghj', '6545', 'kjhgf@dfgh', 'lkjhg joiuiyufyd iohu', '2016-08-10 02:03:30+03', '2');
INSERT INTO "public"."msg_board" VALUES ('cvbnm', '', 'dggdfgd@ggg.ttt', 'yytttt', '2016-08-10 12:28:42+03', '6');
INSERT INTO "public"."msg_board" VALUES (';lkjhgfdfghj', '12345-678-91-22', 'dfghj@mjhgf.jhh', 'fghjhgfdsfg', '2016-08-10 14:26:56+03', '7');
INSERT INTO "public"."msg_board" VALUES ('длорп', '44456-456-99-99', 'dgfdgdf@jhgjghjg.hjhg', 'gdgdfgfdg', '2016-08-10 14:31:48+03', '8');
INSERT INTO "public"."msg_board" VALUES ('jfjhjgj', '55456-888-99-66', 'hgfhgfjhgj@kghkhm.hjh', '.kjhgf', '2016-08-10 14:48:08+03', '10');
INSERT INTO "public"."msg_board" VALUES ('бьfdh888d', '55456.999.88-77', 'kjghg@hfg.ghg', 'dfghjk', '2016-08-10 16:58:31+03', '12');
INSERT INTO "public"."msg_board" VALUES ('kjhgfghj kyfjyfj', '38067-222-33-44', 'lkjh@khjkjh.uu', 'jkjjf l s s ', '2016-08-10 17:09:31+03', '13');
INSERT INTO "public"."msg_board" VALUES ('бьfdhd', '55456.999.88-77', 'kjghg@hfg.ghg', 'dfQQQ3QQghjk', '2016-08-10 18:46:52+03', '9');
INSERT INTO "public"."msg_board" VALUES ('jghjg999', '44258-963-65-75', 'hkjhk@hkjh.lkj', 'ghjkljhgfgughvcx ttfhg', '2016-08-10 18:47:35+03', '11');
INSERT INTO "public"."msg_board" VALUES ('oiuyt', '36578-669-66-22', 'hhjg.llvg@gighj.uhuhu', 'igniufbuydrt goumuymho', '2016-08-10 18:50:39+03', '14');
INSERT INTO "public"."msg_board" VALUES ('lkjhgf', '38044-223-65-47', 'ooio@hhh.jjj', 'oiuytre sdfgh', '2016-08-10 19:10:17+03', '15');
INSERT INTO "public"."msg_board" VALUES (';lkjhdfghj', '38044-587-89-00', 'iufd@scvb.lkjhg', 'jhgfdfg gfdsasrttrw', '2016-08-10 19:20:58+03', '16');
INSERT INTO "public"."msg_board" VALUES ('iugfvbj', '38032-222-33-44', 'kjhgf@dfgh.kjh', 'oifdssdfgh fdsas', '2016-08-10 19:24:17+03', '17');
INSERT INTO "public"."msg_board" VALUES ('fghj', '12345-654-90-12', 'ert@bvc.lkjhg', 'sdfghf dreesaws', '2016-08-10 19:26:08+03', '18');
INSERT INTO "public"."msg_board" VALUES ('oiuyfd', '98765-432-10-12', 'rrr@hhh.kkk', 'kjhfd999s  dfghj', '2016-08-10 19:30:12+03', '19');
INSERT INTO "public"."msg_board" VALUES ('hgfffffff', '11122-333.44.55', 'ggg@ggg.ggg99', 'ggggg gggggg gggggg gggggg', '2016-08-10 19:35:18+03', '20');
COMMIT;

-- ----------------------------
--  Primary key structure for table msg_board
-- ----------------------------
ALTER TABLE "public"."msg_board" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

