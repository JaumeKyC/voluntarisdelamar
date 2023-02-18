export interface Actividades {
    ID:                   number;
    ES_FORMACION:         boolean;//BOOLEANO QUE CONTROLA SI LA ACTIVIDAD ES UNA FORMACION O UN EVENTO, EN CASO DE QUE NO SEA FORMACION SERA EVENTO
    NOMBRE:               string;
    FECHA_INICIO:         Date;
    HORA_INICIO:          Date;
    UBICACION:            string;
    ENTIDAD_ORGANIZADORA: string;
    NUM_EMBARCACIONES:    number;
    NUM_MOTOS:            number;
    NUM_PATRONES:         number;
    NUM_TRIPULANTES:      number;
    NUM_SOCORRISTAS:      number;
    OBSERVACIONES:        string;
    VOLUNTARIOS:          number;
    MAX_VOLUNTARIOS:      number;
    USER_JOINED:          boolean;//BOOLEANO QUE CONTROLA SI EL USUARIO ESTA UNIDO A ESA ACTIVIDAD
}
