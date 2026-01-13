<?php

use Illuminate\Database\Seeder;
use App\ComplaintDetail;

class complaintDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Photo and video   
        */
        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Suratlarda asyl belgisi başgasyna degişli ýa-da olaryň bozulan yzlary bar',
            'ru' => 'На фотографиях видны чужие водяные знаки или следы их удаления',
            'en' => 'Unauthorized watermarks on photos or traces of their removal'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Suratlarda goşmaça reklama bar',
            'ru' => 'На фотографиях дополнительная реклама',
            'en' => 'Additional advertising in the photos'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Keseki suratlar beýleki suratlar bilen ýa-da olarsyz',
            'ru' => 'Посторонние картинки вместо фотографий (не фотографии)',
            'en' => 'Unauthorized photos with/without other photos'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Suratlarda telefon, email, elektron salgylar, ýazgylar bar',
            'ru' => 'На фотографиях ссылки, телефоны, email, надписи',
            'en' => 'Links, telephones, email, signature on photos'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Internetde beýleki zatlardan alnyp düzülen suratlar, desganyň çyzalgasy',
            'ru' => 'В объявлении использованы фотографии, планировки другого объекта из интернета',
            'en' => 'Photos, physical layouts of another object from the Internet'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Binanyň içi barada pikir berjek suratlar ýok',
            'ru' => 'Отсутствует фотографии, позволяющие получить представление об интерьере помещение',
            'en' => 'There are no photos that will give an idea of the interior of the building'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Şol bir suratlar beýleki bildirişde bir başga salgy bilen ýa-da başga otaglar bilen ş.m.',
            'ru' => 'Такие же фотографии использованы в объекте с другим адресом или другим количеством комнат и т.п.',
            'en' => 'The same photos were used in the property with a different address or with different number of rooms, etc.'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Suratlar awtoryň razyçylygy bolmazyndan ulanylýar',
            'ru' => 'Фотографии использоваться без согласия автора',
            'en' => 'Photographs are used without the consent of the author'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '1',
            'tm' => 'Wideo barada şikaýet',
            'ru' => 'Жалоба на видеоролик',
            'en' => 'Complaint for a video'
        ]);
        
        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Bu bildiriş kärende üçin, eýsem satlak üçin däl',
            'ru' => 'Эта аренда, а не продажа',
            'en' => 'This is rent, rather than sale'
        ]);
        
        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Bildirişde ipoteka mümkin diýlip görkezilsede, aslynda ýok',
            'ru' => 'Указано, что ипотека возможно, но на самом деле - нет',
            'en' => 'Indicated that a mortgage is possible, but in fact - not'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Kepillik tölegi ýa-da şol tölegiň mukdary bildirişdäki bilen gabat gelmeýär',
            'ru' => 'Залог, предоплата или размер депозита не соответствует указанному в объявлении',
            'en' => 'The deposit of advance payment or the deposit amount does not match the one indicated in the announcement'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Baha, jaýyň her bölegini bir umumylyk dälde, metr kwadrata düşen bahany goýulypdyr',
            'ru' => 'Цена указана за м. кв., а не за объект в целом',
            'en' => 'The price indicated as per square meter, not per object as a whole'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Satlyk erkin görkezilmesine garamazyndan, aslynda jaý alternatiw (ikitaraplaýyn)',
            'ru' => 'Указано что продажа свободная, но самом деле - альтернативная (встречка)',
            'en' => 'Indicated that the sale is free, but in fact - an alternative (reciprocal)'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Bahanyň çap edilen ýerinde ýalňyşlyk',
            'ru' => 'Явная опечатка в поле цена',
            'en' => 'An obvious typo in the price field'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Baha bildirişde görezileninden has köp',
            'ru' => 'Цена больше, чем указано в объявлении',
            'en' => 'The price is more than stated in the announcement'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '2',
            'tm' => 'Kommisiýa bildirişde görkezileninden has köp',
            'ru' => 'Комиссия больше, чем указано в объявлении',
            'en' => 'Commission is more than stated in the announcement'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Umumy meýdan otaglaryň meýdanyna ýa-da olaryň sanyna gabat gelmeýär',
            'ru' => 'Общая площадь не соответствует площади комнат или их количеству',
            'en' => 'The total area does not correspond to the area of the rooms or their number'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Hakyky meýdany bildirişde görkezileninden has az',
            'ru' => 'Действительная площадь намного меньше указанной',
            'en' => 'The actual area is much less than indicated'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Bu öňden bar bolan binýat dälde, eýsem täze gurulýan bina',
            'ru' => 'Это не вторичка, а новостройка',
            'en' => 'This is not existing housing, but a new building'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Bu jaý dälde, eýsem ýöne otag',
            'ru' => 'Это не квартира, а комната',
            'en' => 'This is not an apartment, but a room'
        ]);
        
        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Bu jaý dälde, eýsem ýatakly ýer',
            'ru' => 'Это не квартира, а койко-место',
            'en' => 'This is not an apartment, but a accommodation with bed'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Bu jaý dälde, eýsem jaýyň paýlaşylan bir bölegi',
            'ru' => 'Это не квартира, а доля в квартире',
            'en' => 'This is not an apartment, but a shared proportion of an apartment'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Bu jaý dälde. eýsem jaýyň bir bölegi ýa-da hususy jaý',
            'ru' => 'Это не квартира, а часть дома или частный дом',
            'en' => 'This is not an apartment, but a part of a house or a private house'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Jaýyň ýerleşýän gaty ýalňyş',
            'ru' => 'Этаж указан неверно',
            'en' => 'Floor is incorrect'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Binanyň umumy gat sany ýalňyş',
            'ru' => 'Этажность дома указан неверно',
            'en' => 'Total floor of building is incorrect'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '3',
            'tm' => 'Mebel, öý tehniki enjamlary ýa-da öý infrastrukturalar bar diýlip görkezilsede, aslynda ýok',
            'ru' => 'Указано, что мебель, техника или инфраструктура имеется, но самом деле отсутсвуют',
            'en' => 'indicated that furniture, equipment or infrastructure is available, but in fact they are absent'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '4',
            'tm' => 'Şäher, welaýat ýa-da etrap salgysy ýalňyş',
            'ru' => 'Город, область или регион неверные',
            'en' => 'City, state or region is incorrect'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '4',
            'tm' => 'Köçe ýa-da jaý salgysy ýalňyş',
            'ru' => 'Улица, дом или район неверные',
            'en' => 'Street, house or district incorrect'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '5',
            'tm' => 'Telefona jogap bermeýär ýada telefony goýýar',
            'ru' => 'Телефон никогда не отвечает или сбрасывает',
            'en' => 'The phone never responds or discards'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '5',
            'tm' => 'Abonent ýok (ýada telefonyň nomer toplumy nädogry)',
            'ru' => 'Абонент не существует (или невозможной комплект цифр в номере)',
            'en' => 'Telephone subscriber does not exist (or the set of digits in the number is inadmissible)'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Bildirişde ulanylan suratlar internetden alnyp düzülen suratlar',
            'ru' => 'В объявлении использованы фотографии другого объекта из интернета',
            'en' => 'Photos used in the announcement are of another object from Internet'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Jaň etdim. Meni başga saýtda gönikdirdiler ýada satyjy bu bildirişiň reklamlygyny habar berdi',
            'ru' => 'Позвонил. Предложили выбрать на другом сайте или агент сообщил праямо, что это рекламное объявление',
            'en' => 'Called. They offered to choose on another site or the agent told directly that announcement was an advertisement'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Jaň etdim. Bildirişdäki jaý satylan ýa-da kärendä berilen',
            'ru' => 'Позвонил. Объект продан/сдан',
            'en' => 'Called. Property is sold/rented'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Gözden giçirmäge gittim. Bina goýulan suratlara gabat gelýär, ýöne ol başga salgyda ýerleşýän eken',
            'ru' => 'Был на просмотре. Объект соответствует фотографиям, но находится по другому адресу (в другом доме)',
            'en' => 'Gone to review. The property corresponds to the photos, but is located at a different address (in another building)'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Gözden giçirmäge gittim. Öýüň ýerleşýän gaty gabat gelmeýär',
            'ru' => 'Был на просмотре. Показывают объект на другом этаже',
            'en' => 'Gone to review. Floor of the property is different than stated'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Gözden giçirmäge gittim. Öýüň ýerleşýän gaty gabat gelýär, ýöne suratlaryň bildiriş bilen hiç hili baglanşygy ýok',
            'ru' => 'Был на просмотре. Показывают объект по этому же адресу, но не имеющий ничего общего с фотографиями',
            'en' => 'Gone to review. Floor of the property corresponds but the photos are irrelevant with that'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Jaň etdim. Gözden geçirmäge rugsat alyp bilmedi. Ondan soňra, satyjydan ýa-da agentiň işgärlerinden dürli teklipler bilen habarlaşdylar',
            'ru' => 'Позвонил. Не удалось договориться о просмотре. После этого посыпались звонки от этого или других агентов с предлажениям',
            'en' => 'Called. Could not receive acceptence for review. After that, calls from the dealer or other agents were made with different offers'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Birnäçe gezek jaň etdim. Görnüşe görä jaý bar, ýöne gözden geçirmek üçin rugsat alyp bolmady. Ýene başga teklipleri berýär',
            'ru' => 'Звонил много раз. Объект вроде бы существует, но договариться о просмотре неудается. Предлагают другие варианты',
            'en' => 'Called many time. The property seems to exist, yet could not receive acceptance for review. And offered other options'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '6',
            'tm' => 'Men jaýy/jaýlary satýan hususy satyjy (ýa-da agentiň işgäri): öýümi bilen ylalaşdym, ýöne bildirişim bildiriş sahypasyndan aýrylmady',
            'ru' => 'Я - собственник (или Я агент, проводивший сделку): объект уже реализован, но объявления не снято',
            'en' => 'I am a dealer (or agent, making a property deal): the property was negotiated, yet it is not canceled in announcement page'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '7',
            'tm' => 'Agentiň işgäri telefonda gödek gürleşýär',
            'ru' => 'Агент хамить по телефону',
            'en' => 'Agent was rude on  the phone'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '7',
            'tm' => 'Jaýy gözden geçirmeden öň ilk tölegi geçirmegi teklip ettiler',
            'ru' => 'Предлагают внести предоплату до просмотра',
            'en' => 'They offered to make a prepayment before review'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '7',
            'tm' => 'Satyjy bir hilegär we bu barada polisiýa habar berildi',
            'ru' => 'Это мошенник, написано заявление в полицию',
            'en' => 'He/She is a swindler and police has already informed about that'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '7',
            'tm' => 'Telefonda hiç hili jaýy satmaýandygyny ýa-da kärendesine bermeýändigini we beýle iş bilen meşgullanmaýandygyny aýtdy - bu başga biriniň nomeri',
            'ru' => 'По телефону отвечают, что ничего не предлагают и не знают, указан - чужой телефон',
            'en' => 'On the phone they say that they do not sell/rent anything or do not know anything about property - it is someone\'s phone'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '7',
            'tm' => 'Bildiriş jaýyň razyçyly bolmazyndan goýulypdyr',
            'ru' => 'Объявление размещено без согласия собственника',
            'en' => 'The property is posted without the owner\'s consent'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '8',
            'tm' => 'Bildirişde telefon, email, internet salgysy ýok',
            'ru' => 'В описании присутствуют телефоны, ссылки, е-mail',
            'en' => 'In detail part of the property, telephone, links, email are absent'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '8',
            'tm' => 'Bildirişdäki ýerleşýän reklama hyzmaty hödürlenýän jaý bilen bagly däl',
            'ru' => 'В объявлении реклама услуг, не относящихся к предлагаемому объекту',
            'en' => 'Advertising service in the annnoncement is not related to the proposed property'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '8',
            'tm' => 'Bildirişde bir däl, eýsem birnäçe jaý görkezilipdir (ýa-da beýleki görnüşleri hödürlenýär)',
            'ru' => 'В описании объявления предлагается несколько объектов (или предлагаются другие варианты)',
            'en' => 'In detail part of the property, not one but many properties are announced (or other options are offered)'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '8',
            'tm' => 'Bildirşiň ýazgysynda birnäçe ýalňyşlyk ýa-da kemsidiji sözler ulanylypdyr',
            'ru' => 'Много ошибок в тексте или оскорбительные выражения',
            'en' => 'So many errors in the text or slanderous expressions'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '9',
            'tm' => 'Başga salgydaky bir bildirişde şu suratlar bar',
            'ru' => 'Есть объявление по другому адресу, но с такими же фотографиями',
            'en' => 'There is a property with different address but with the same photos'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '9',
            'tm' => 'Gaty başga, otaglaryň sany, tutýan meýdany we ş.m. başga bolan bildirişde şu suratlar ulanylypdyr',
            'ru' => 'Есть объявление с другим этажом, количеством комнат, площадью и т.п., но с такими же фотографиями',
            'en' => 'There is a property with different floor, the number of rooms, the area, etc., but with the same photos'
        ]);

        ComplaintDetail::create([
            'complaint_id' => '9',
            'tm' => 'Gaty başga, otaglaryň sany, tutýan meýdany we ş.m. başga bolan bildirişde şu suratlar ulanylypdyr',
            'ru' => 'Есть объявление с другим этажом, количеством комнат, площадью и т.п., но с такими же фотографиями',
            'en' => 'There is a property with different floor, the number of rooms, the area, etc., but with the same photos'
        ]);
    }
}
